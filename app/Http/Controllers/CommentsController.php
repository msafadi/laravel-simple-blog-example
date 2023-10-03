<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CommentsController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'user_name' => $request->input('cName'),
            'content' => $request->input('cMessage'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'published'
        ]);

        $users = User::whereIn('type', ['admin', 'super-admin'])->get();
        if ($users) {
            //$user->notify(new NewCommentNotification($comment));
            Notification::send($users, new NewCommentNotification($comment));
        }

        return back()->with('success', 'Your comment added!');
    }
}
