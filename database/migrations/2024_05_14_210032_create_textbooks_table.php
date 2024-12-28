<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('textbooks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_file_name')->nullable();
            $table->text('description');
            $table->unsignedInteger('price'); //unsignedInteger..マイナス設定ができない
            $table->string('state');  //販売中・売却済みの判断
            $table->boolean('is_selling')->nullable();  //販売・販売停止にできる
            $table->foreignId('buyer_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('university_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); //外部キー制約
            $table->foreignId('faculty_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); //外部キー制約
            $table->timestamp('bought_at')->nullable();  //出品中の商品を先に購入済みの商品を後に並び替えできる
            $table->timestamps();
            $table->foreignId('item_condition_id')->constrained()->onUpdate('cascade')->onDelete('cascade');//商品の状態
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('textbooks');
    }
};
