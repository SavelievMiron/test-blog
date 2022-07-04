<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class PostScreen extends Screen
{
    private Post $post;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Post $post): iterable
    {
        $this->post = $post;

        return [
            'post' => $post
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return "Post '{$this->post->title}'";
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
            Layout::legend('post', [
                Sight::make('title', 'Title'),
                Sight::make('slug', 'Slug'),
                Sight::make('author', 'Author')->render(function () {
                    return optional($this->post->author)->name;
                }),
                Sight::make('categories', 'Categories')->render(function () {
                    if ($this->post->categories()->exists()) {
                        $links = [];
                        foreach ($this->post->categories as $category) {
                            $links[] = Link::make($category->name)
                                           ->route('platform.categories.read', $category->id);
                        }
                        return implode(',', $links);
                    }
                }),
                Sight::make('content', 'Content'),
            ]),
        ];
    }
}
