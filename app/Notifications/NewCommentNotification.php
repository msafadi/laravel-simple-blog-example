<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    protected $comment;
    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Channels: mail, database, broadcast, vonage (sms), slack
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Comment')
                    ->greeting('Hi ' . $notifiable->name)
                    ->line("A new comment has been added on post ({$this->comment->commentable->title})")
                    ->action('View post', route('posts.show', $this->comment->commentable->slug))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'title' => 'New Comment',
            'body' => "A new comment has been added on post ({$this->comment->commentable->title})",
            'image' => '',
            'link' => route('posts.show', $this->comment->commentable->slug),
            'comment_id' => $this->comment->id,
            'post_id' => $this->comment->commentable_id,
        ]);
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => 'New Comment',
            'body' => "A new comment has been added on post ({$this->comment->commentable->title})",
            'image' => '',
            'link' => route('posts.show', $this->comment->commentable->slug),
            'comment_id' => $this->comment->id,
            'post_id' => $this->comment->commentable_id,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
