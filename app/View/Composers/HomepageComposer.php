<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class HomepageComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $posts = Post::latest()->paginate(1);

        $view->with('posts', $posts);
    }
}
