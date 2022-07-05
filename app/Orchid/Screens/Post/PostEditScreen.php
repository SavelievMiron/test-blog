<?php

namespace App\Orchid\Screens\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PostEditScreen extends Screen
{
    private bool $exist = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Post $post): iterable
    {
        $this->exist = $post->exists;

        return [
            'post'       => $post,
            'author'     => $post->author,
            'thumbnail'  => optional($post->thumbnail)->id,
            'categories' => $post->categories
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return ($this->exist) ? 'Edit Post' : 'Create Post';
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
                  ->confirm('Are you sure you want to remove this post?')
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
                    Input::make('post.title')
                         ->type('text')
                         ->max(255)
                         ->title('Title')
                         ->placeholder('Title')
                         ->required()
                         ->horizontal(),
                    Input::make('post.slug')
                         ->type('text')
                         ->max(60)
                         ->title('Slug')
                         ->placeholder('Slug')
                         ->required()
                         ->horizontal(),
                    Quill::make('post.content')
                         ->toolbar(["text", "color", "header", "list", "format", "media"])
                         ->title('Content')
                         ->required()
                         ->horizontal(),
                    Cropper::make('thumbnail')
                           ->width(500)
                           ->height(300)
                           ->title('Thumbnail')
                           ->targetId()
                           ->horizontal(),
                    Relation::make('categories')
                            ->fromModel(Category::class, 'name', 'id')
                            ->title('Categories')
                            ->horizontal(),
                    Relation::make('author')
                            ->fromModel(User::class, 'name', 'id')
                            ->title('Author')
                            ->required()
                            ->horizontal(),
                ]
            )
        ];
    }

    public function save(Post $post, Request $request)
    {
        $data = $request->get('post');

        $data['slug'] = strtolower($data['slug']);

        $post->fill($data);

        if ($request->has('author')) {
            $post->author()->associate($request->input('author'));
        }

        if ($request->has('categories')) {
            $post->categories()->sync($request->input('categories'));
        }

        if ($request->has('thumbnail')) {
            $post->thumbnail = $request->input('thumbnail');
        }

        $post->save();

        return redirect()->route('platform.posts');
    }

    public function remove(Post $post)
    {
        $post->delete();

        return redirect()->route('platform.posts');
    }
}
