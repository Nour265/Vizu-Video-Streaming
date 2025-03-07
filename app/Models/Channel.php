<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $primaryKey = 'CID';

    protected $fillable = [
        'UID', 'sub_count', 'date_created', 'description', 'is_creator'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UID');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'CID');
    }
}

