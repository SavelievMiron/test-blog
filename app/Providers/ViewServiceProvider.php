<?php

namespace App\Providers;

use App\View\Composers\DashboardComposer;
use App\View\Composers\HomepageComposer;
use App\View\Composers\PostCardComposer;
use App\View\Composers\PostComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Homepage
        View::composer('index', HomepageComposer::class);
        // Blog
        View::composer('pages.dashboard.index', DashboardComposer::class);
        // Blog Post
        View::composer('blog.post', PostComposer::class);
        // Blog Post Card
        View::composer(['blog.card', 'blog.article_card'], PostCardComposer::class);
    }
}
