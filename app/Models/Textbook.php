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

    public function scopeSortOrder($query, $sortOrder)
    {
        //sortOrderの数値がconstantで指定したどの定数と一致するか条件分岐
        if ($sortOrder === null || $sortOrder === \Constant::SORT_ORDER['recommend']) {
            //orderByRawメソッド...ORDER BY句のSQLを直接記述することが可能。メソッドの中身のsqlを展開すると以下のようになる
            //ORDER BY FIELD(state, 'selling', 'bought')
            //FIELDはSQLの関数で、第一引数で指定した値が第二引数以降の何番目に該当するかを返えす
            //stateがsellingの場合は1、boughtの場合は2を返しており、これを昇順で並べ替えることで、出品中(selling)の商品が先に、購入済み(bought)の商品が後になるようにソートされ
            return $query->orderByRaw("FIELD(state, '" . self::STATE_SELLING . "', '" . self::STATE_BOUGHT . "')");
        }
        if ($sortOrder === \Constant::SORT_ORDER['higherPrice']) {
            return $query->orderBy('price', 'desc');
        }
        if ($sortOrder === \Constant::SORT_ORDER['lowerPrice']) {
            return $query->orderBy('price', 'asc');
        }
        if ($sortOrder === \Constant::SORT_ORDER['later']) {
            return $query->orderBy('textbooks.created_at', 'desc');
        }
        if ($sortOrder === \Constant::SORT_ORDER['older']) {
            return $query->orderBy('textbooks.created_at', 'asc');
        }
    }

    public function scopeSelectCategory($query, $categoryId)
    {
        //もしカテゴリーを選んでいたら
        if ($categoryId !== '0') {
            //カテゴリーidで条件指定する
            return $query->where('secondary_category_id', $categoryId);
        } else {
            return;
        }
    }

    public function scopeSearchKeyword($query, $keyword)
    {
        if (!is_null($keyword)) {
            //全角スペースを半角に
            $spaceConvert = mb_convert_kana($keyword, 's');

            //空白で区切る
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach ($keywords as $word) {
                $query->where('name', 'like', '%' . $word . '%');
            }

            return $query;
        } else {
            return;
        }
    }
}
