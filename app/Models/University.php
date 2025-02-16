<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    public function textbooks()
    {
        return $this->hasMany(Textbook::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeSearchKeyword($query, $keyword)
    {
        if (!is_null($keyword)) {
            // 全角スペースを半角に変換
            $spaceConvert = mb_convert_kana($keyword, 's');

            // キーワードを空白で分割
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);

            // 各キーワードを部分一致で検索
            foreach ($keywords as $word) {
                $query->where('name', 'like', '%' . $word . '%');
            }

            return $query;
        }
        return $query; // 必要に応じて空クエリを返す
    }
}
