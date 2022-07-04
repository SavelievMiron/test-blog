<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Name')
              ->cantHide()
              ->width('15%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT)
              ->render(function (Category $category) {
                  return Link::make($category->name)
                             ->route('platform.categories.read', $category->id);
              }),
            TD::make('slug', 'Slug')
              ->cantHide()
              ->width('10%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT),
            TD::make('posts', 'Posts')
              ->cantHide()
              ->width('10%')
              ->filter(TD::FILTER_TEXT)
              ->sort()
              ->align(TD::ALIGN_LEFT)
              ->render(function (Category $category) {
                  return $category->posts()->count();
              }),
            TD::make('created_at', 'Created At')
              ->sort()
              ->width('10%')
              ->cantHide()
              ->filter(TD::FILTER_DATE)
              ->render(function (Category $category) {
                  return $category->created_at;
              }),
            TD::make(__('Actions'))
              ->align(TD::ALIGN_CENTER)
              ->width('10%')
              ->cantHide()
              ->render(function (Category $category) {
                  return DropDown::make()
                                 ->icon('options-vertical')
                                 ->list(
                                     [
                                         Link::make('Edit')
                                             ->route('platform.categories.edit', $category->id)
                                             ->icon('pencil'),

                                         Button::make('Delete')
                                               ->action(route(
                                                   'platform.categories.edit',
                                                   [$category, 'remove']
                                               ))->icon('trash')
                                               ->confirm('Do you really want to delete this product?'),
                                     ]
                                 );
              }),
        ];
    }
}
