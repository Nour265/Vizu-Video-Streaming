<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentRate extends Model
{
    use HasFactory;

    protected $primaryKey = 'CRID';

    protected $fillable = [
        'UID', 'VidID', 'rating', 'comment_text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UID');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'VidID');
    }
}
