<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'university_id',
        'faculty_id',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function postRoomUsers()
	{
	    return $this->hasMany(PostRoomUser::class);
	}

	public function postMessages()
	{
	    return $this->hasMany(PostMessage::class);
	}
}
