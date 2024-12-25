<?php

namespace Database\Factories;

use App\Models\Textbook;
use App\Models\User;
use App\Models\University;
use App\Models\Faculty;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Textbook>
 */
class TextbookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 出品者IDを既存のユーザーからランダムに選択
        $sellerIds = User::pluck('id')->toArray();
        $sellerId = $this->faker->randomElement($sellerIds);

        // 既存の大学IDを取得
        $universityIds = University::pluck('id')->toArray();
        // ランダムな大学IDを選択
        $universityId = $this->faker->randomElement($universityIds);

        // 選択された大学に紐づく学部のIDを取得
        $facultyIds = Faculty::where('university_id', $universityId)->pluck('id')->toArray();

        // ランダムな学部IDを選択
        $facultyId = $this->faker->randomElement($facultyIds);

        // 状態をランダムに設定
        $state = $this->faker->randomElement([Textbook::STATE_SELLING, Textbook::STATE_BOUGHT]);

         // public/textbooks/ ディレクトリからランダムな画像ファイルを選択
         $imageFiles = Storage::files('public/textbooks');

         if (empty($imageFiles)) {
             // ディレクトリに画像がない場合はデフォルトの画像を設定
             $fileNameToStore = 'default.jpg';
         } else {
             // ファイルパスからファイル名を取得し、ランダムに選択
             $fileNames = array_map(function ($filePath) {
                 return basename($filePath);
             }, $imageFiles);

             $fileNameToStore = $this->faker->randomElement($fileNames);
         }

        return [
            'name' => $this->faker->sentence, // 書籍名を生成
            'image_file_name' => $fileNameToStore,
            'description' => $this->faker->paragraph, // 説明文を生成
            'price' => $this->faker->numberBetween(1000, 100000), // 価格を生成
            'state' => $state,
            'is_selling' => null,
            'buyer_id' => null,
            'seller_id' => $sellerId, // 出品者ID（新規ユーザーを生成）
            'university_id' => $universityId, // 既存の大学IDを使用
            'faculty_id' => $facultyId, // 選択された大学に紐づく学部IDを使用
            'bought_at' => null,
            'item_condition_id' => $this->faker->numberBetween(1, 6),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // 過去1年以内の日時を生成
            'updated_at' => now(), // 現在の日時を設定
        ];
    }
}
