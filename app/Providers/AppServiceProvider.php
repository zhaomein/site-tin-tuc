<?php

namespace App\Providers;
use Illuminate\Contracts\Auth\Guard;
use App\Category;
use App\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
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
    public function boot(Guard $auth)
    {
        Schema::defaultStringLength(191);

        if(Schema::hasTable('categories')) {
            $categories = Category::all();

            $menuItems = [
                [
                    'name' => 'Trang chủ',
                    'link' => '/'
                ]
            ];

            foreach($categories as $cat) {
                $menuItems[] = [
                    'name' => $cat->name,
                    'link' => "/$cat->slug"
                ];
            }
            $lastestPosts = Post::limit(3)->orderBy("created_at", 'DESC')->get();
            $lastestPosts->load('category', 'user');

            $trendingPosts = Post::limit(10)->orderBy("views", 'DESC')->get();
            $trendingPosts->load('category', 'user');

            view()->share(compact('menuItems', 'trendingPosts', 'lastestPosts'));
        }

        view()->composer('*', function($view) use ($auth) {
            $currentUser = $auth->user();
            $view->with('loginUser', $currentUser);
        });

    }
}
