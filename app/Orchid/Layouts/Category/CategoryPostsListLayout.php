<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryPostsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'posts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title')
              ->cantHide()
              ->width('50%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT)
              ->render(function (Post $post) {
                  return Link::make($post->title)
                             ->route('platform.posts.read', $post->id);
              }),
            TD::make('slug', 'Slug')
              ->cantHide()
              ->width('50%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT),
        ];
    }
}
