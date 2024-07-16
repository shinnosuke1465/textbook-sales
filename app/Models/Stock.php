<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'textbook_id',
        'quantity'
    ];

    public function textbook()
    {
        return $this->belongsTo(Textbook::class);
    }
}
