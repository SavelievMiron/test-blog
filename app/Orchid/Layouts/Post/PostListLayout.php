<?php

namespace App\Orchid\Layouts\Post;

use App\Models\Post;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
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
              ->width('20%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT)
              ->render(function (Post $post) {
                  return Link::make($post->title)
                             ->route('platform.posts.read', $post->id);
              }),
            TD::make('slug', 'Slug')
              ->cantHide()
              ->width('20%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT),
            TD::make('categories', 'Categories')
              ->cantHide()
              ->width('20%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT)
                ->render(function (Post $post) {
                    if ($post->categories()->exists()) {
                        $links = [];
                        foreach ($post->categories as $category) {
                            $links[] = Link::make($category->name)
                                ->route('platform.categories.read', $category->id);
                        }
                        return implode(',', $links);
                    }
                }),
            TD::make('author', 'Author')
              ->cantHide()
              ->width('20%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT)
              ->render(function (Post $post) {
                  if ($post->author()->exists()) {
                      $author = $post->author;
                      return Link::make($author->name)
                                 ->route('platform.systems.users.edit', $author->id);
                  }
              }),
            TD::make('created_at', 'Created At')
              ->sort()
              ->width('10%')
              ->cantHide()
              ->filter(TD::FILTER_DATE)
              ->render(function (Post $post) {
                  return $post->created_at;
              }),
            TD::make(__('Actions'))
              ->align(TD::ALIGN_CENTER)
              ->width('10%')
              ->cantHide()
              ->render(function (Post $post) {
                  return DropDown::make()
                                 ->icon('options-vertical')
                                 ->list(
                                     [
                                         Link::make('Edit')
                                             ->route('platform.posts.edit', $post->id)
                                             ->icon('pencil'),

                                         Button::make('Delete')
                                               ->action(route(
                                                   'platform.posts.edit',
                                                   [$post, 'remove']
                                               ))->icon('trash')
                                               ->confirm('Do you really want to delete this product?'),
                                     ]
                                 );
              }),
        ];
    }
}
