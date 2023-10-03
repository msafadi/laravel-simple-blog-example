<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function($user, $ability) {
            if ($user->type == 'user') {
                return false;
            }
        });
        Gate::define('posts.view', function ($user) {
            return !($user->type == 'user');
        });
        Gate::define('posts.create', function ($user) {
            return ($user->type == 'admin' || $user->type == 'super-admin');
        });
        Gate::define('posts.update', function ($user) {
            return ($user->type == 'admin' || $user->type == 'super-admin');
        });
        Gate::define('posts.delete', function ($user) {
            return $user->type == 'super-admin';
        });
    }
}
