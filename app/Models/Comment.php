<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'post_id',
        'user_id',
    ];

    public function post(){

        return $this->BelongsTo(Post::class);
    }
    
    public function user(){

        return $this->BelongsTo(User::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'commentable');
    }
}
