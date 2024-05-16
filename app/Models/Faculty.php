<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function textbooks()
    {
        return $this->hasMany(Textbook::class);
    }
}
