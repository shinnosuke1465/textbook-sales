<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    // 画像とフォルダ名が渡される
    public static function upload($imageFile, $folderName)
    {
        // ファイルを判別
        $file = is_array($imageFile) ? $imageFile['image'] : $imageFile;

        // ファイル名を生成
        $fileName = uniqid(rand() . '_');
        $extension = $file->extension();
        $fileNameToStore = $fileName . '.' . $extension;

        // ImageManagerを利用して画像をリサイズ
        $manager = new ImageManager(new Driver());
        $resizedImage = $manager->read($file->getRealPath())
                                ->resize(200, 200)
                                ->encode();

        // リサイズ後の画像を保存
        Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }

    public static function productUpload($imageFile, $folderName)
    {
        // ファイルを判別
        $file = is_array($imageFile) ? $imageFile['image'] : $imageFile;

        // ファイル名を生成
        $fileName = uniqid(rand() . '_');
        $extension = $file->extension();
        $fileNameToStore = $fileName . '.' . $extension;

        // ImageManagerを利用して画像をリサイズ
        $manager = new ImageManager(new Driver());
        $resizedImage = $manager->read($file->getRealPath())
                                ->resize(300, 300)
                                ->encode();

        // リサイズ後の画像を保存
        Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }
}
