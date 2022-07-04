<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
    private bool $exist = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        $this->exist = $category->exists;

        $posts = $category->posts;

        return [
            'category'  => $category,
            'posts' => $posts
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return ($this->exist) ? 'Edit Category' : 'Create Category';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                  ->icon('check')
                  ->method('save'),

            Button::make('Remove')
                  ->icon('trash')
                  ->method('remove')
                  ->confirm('Are you sure you want to remove this category?')
                  ->canSee($this->exist),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows(
                [
                    Input::make('category.name')
                         ->type('text')
                         ->max(255)
                         ->title('Name')
                         ->placeholder('Name')
                         ->required()
                         ->horizontal(),
                    Input::make('category.slug')
                         ->type('text')
                         ->max(60)
                         ->title('Slug')
                         ->placeholder('Slug')
                         ->required()
                         ->horizontal(),
                    Relation::make('posts')
                            ->fromModel(Post::class, 'title', 'id')
                            ->multiple()
                            ->title('Posts')
                            ->horizontal(),
                ]
            )
        ];
    }

    public function save(Category $category, Request $request)
    {
        $data = $request->get('category');

        $category->fill($data);

        if ($request->has('posts')) {
            $category->posts()->sync($request->input('posts'));
        }

        $category->save();

        return redirect()->route('platform.categories');
    }

    public function remove(Category $category)
    {
        $category->delete();

        return redirect()->route('platform.categories');
    }
}
