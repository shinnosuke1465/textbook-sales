<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stock;
use App\Models\Textbook;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 既存の教科書IDを取得
        $textbookIds = Textbook::pluck('id')->toArray();
        $textbook = Textbook::find($this->faker->randomElement($textbookIds));
        // 状態に応じて quantity を設定
        if ($textbook->state === Textbook::STATE_SELLING) {
            $quantity = 1;
        } else {
            $quantity = 0;
        }
        return [
            'textbook_id' => $textbook->id,
            'quantity' => $quantity,
        ];
    }
}
