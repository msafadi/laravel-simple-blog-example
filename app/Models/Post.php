<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = [
        'deleted_at', 'updated_at', 'featured_image_path',
    ];

    protected $appends = [
        'featured_image_url',
    ];

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image_path) {
            return Storage::disk('public')->url($this->featured_image_path);
        }
        return '';
    }

    protected static function booted()
    {
        // static::addGlobalScope('published', function (Builder $builder) {
        //     $builder->where('status', '=', 'published')
        //         ->where('published_at', '<=', now());
        // });
    }

    public function scopePublished(Builder $builder)
    {
        $builder->where('status', '=', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeStatus(Builder $builder, $status)
    {
        $builder->where('status', '=', $status);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
            ->withDefault([
                'name' => 'Unknown'
            ]);
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_post',
            'post_id',
            'category_id',
            'id',
            'id'
        );
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
