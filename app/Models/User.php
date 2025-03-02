<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function likes() {
        return $this->hasOne(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
