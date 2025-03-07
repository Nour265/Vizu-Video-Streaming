<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'UID';

    protected $fillable = [
        'role', 'email', 'password', 'username', 'age', 'gender', 'date_joined', 'profile_picture'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function channels()
    {
        return $this->hasMany(Channel::class, 'UID');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'UID');
    }

    public function comments()
    {
        return $this->hasMany(CommentRate::class, 'UID');
    }
}

