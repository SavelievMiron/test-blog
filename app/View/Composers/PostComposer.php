<?php

namespace App\View\Composers;

use Illuminate\View\View;

class PostComposer {
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = $view->getData();

        if (!empty($data['post'])) {
            $categories = array_map(function($cat) {
                return $cat['name'];
            }, $data['post']->categories->toArray());

            $view->with('categories', $categories);
        }
    }
}
