<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $primaryKey = 'VidID';

    protected $fillable = [
        'CID', 'UID', 'length', 'upload_date', 'genre', 'view_count'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'CID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UID');
    }

    public function comments()
    {
        return $this->hasMany(CommentRate::class, 'VidID');
    }
    public function ratings() {
        return $this->hasMany(CommentRate::class);
    }
}

