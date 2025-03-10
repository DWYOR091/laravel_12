<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();


        // Gate::define('blog-namabebas', function (User $user, Blog $blog) {
        //     return $user->id === $blog->author_id;
        // });

        //custome msg
        Gate::define('blog-namabebas', function (User $user, Blog $blog) {
            return $user->id === $blog->author_id
                ? Response::allow()
                : Response::deny('Anda bukan author!!');
        });
    }
}
