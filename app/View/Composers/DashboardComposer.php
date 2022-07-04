<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class DashboardComposer
{
//    protected $users;
//
//    public function __construct(UserRepository $users)
//    {
//        $this->users = $users;
//    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $posts = Post::where('user_id', 1)->paginate(1);

        $view->with('posts', $posts);
    }
}
