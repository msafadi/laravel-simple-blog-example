<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'user_name', 'content', 'status', 'ip_address', 'user_agent',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
