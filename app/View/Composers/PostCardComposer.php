<?php

namespace App\View\Composers;

use Illuminate\View\View;

class PostCardComposer {
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = $view->getData();

        if (empty($data['post'])) {
            return;
        }

        $post = $data['post'];

        $categories = array_map(function($cat) {
            return $cat['name'];
        }, $data['post']->categories->toArray());

        if (!empty($post->thumbnail)) {
            $thumbnail = $post->thumbnail->url();
            $view->with('thumbnail', $thumbnail);
        }

        $view->with('categories', $categories);
    }
}
