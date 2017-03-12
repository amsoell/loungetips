<?php

namespace App;

use Riari\Forum\Models\Post;
use Riari\Forum\Models\Thread;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tips() {
        return $this->hasMany(Tip::class);
    }

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function threads() {
        return $this->hasMany(Thread::class, 'author_id');
    }
}
