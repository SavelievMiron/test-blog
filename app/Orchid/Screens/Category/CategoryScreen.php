<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryPostsListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class CategoryScreen extends Screen
{
    private Category $category;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        $this->category = $category;

        return [
            'category' => $category,
            'posts'    => $category->posts
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return "Category '{$this->category->name}'";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('category', [
                Sight::make('name'),
                Sight::make('slug'),
            ]),
            CategoryPostsListLayout::class
        ];
    }
}
