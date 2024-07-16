<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Textbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_file_name',
        'description',
        'price',
        'state',
        'sort_order',
        'is_selling',
        'buyer_id',
        'seller_id',
        'university_id',
        'faculty_id',
        'bought_at',
        'item_condition_id',
    ];

    // 出品中
    const STATE_SELLING = 'selling';
    // 購入済み
    const STATE_BOUGHT = 'bought';

    protected $casts = [
       'bought_at' => 'datetime',
   ];

    public function university()
     {
         return $this->belongsTo(University::class);
     }

    public function faculty()
     {
         return $this->belongsTo(Faculty::class);
     }

    public function condition()
     {
         return $this->belongsTo(ItemCondition::class, 'item_condition_id');
     }

    public function seller()
     {
         return $this->belongsTo(User::class, 'seller_id');
     }

     public function getIsStateSellingAttribute()
     {
         return $this->state === self::STATE_SELLING;
     }

     public function getIsStateBoughtAttribute()
     {
         return $this->state === self::STATE_BOUGHT;
     }

     public function stock()
     {
        return $this->hasOne(Stock::class);
     }
}
