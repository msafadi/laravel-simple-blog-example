<?php

use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Middleware\EnsureUserType;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->as('admin.')
    ->middleware(['auth', 'user.type:super-admin,admin'])->group(function() {
    
    Route::get('profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/notifications', [NotificationsController::class, 'index'])
        ->name('notifications.index');
    Route::put('/notifications/{id}/read', [NotificationsController::class, 'read'])
        ->name('notifications.read');
    Route::put('/notifications/{id}/unread', [NotificationsController::class, 'unread'])
        ->name('notifications.unread');
    Route::delete('/notifications/{id}', [NotificationsController::class, 'destroy'])
        ->name('notifications.destroy');

    Route::prefix('/posts')
        ->as('posts.')
        ->controller(PostsController::class)
        ->group(function() {
            Route::get('/trashed', 'trashed')
                ->name('trashed');
            Route::put('/trashed/{id}', 'restore')
                ->name('restore');
            Route::delete('/trashed/{id}', 'forceDelete')
                ->name('force-delete');
        });

        // Route::resource('/posts', PostsController::class);
        // Route::resource('/users', UsersController::class);
        Route::resources([
            '/posts' => PostsController::class,
            '/users'=> UsersController::class,
        ]);
});



