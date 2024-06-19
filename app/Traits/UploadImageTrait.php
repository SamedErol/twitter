<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;

trait UploadImageTrait
{
    public function uploadImage(UploadedFile $file, string $folder): string
    {
        $fileDirectory = 'uploads/images/' . $folder;

        $fileName = uniqid() . '.webp';

        $manager = new ImageManager(new GdDriver());

        $image = $manager->read($file);

        $image->toWebp(80);

        $image->save(public_path($fileDirectory . '/' . $fileName));

        return $fileName;
    }

    public function uploadMultiImage(array $files, string $folder): array
    {
        $fileDirectory = 'uploads/images/' . $folder;
        $fileNames = [];

        foreach ($files as  $file) {
            $fileName = uniqid() . '.webp';

            $manager = new ImageManager(new GdDriver());

            $image = $manager->read($file);

            $image->save(public_path($fileDirectory . '/' . $fileName));

            array_push($fileNames, $fileName);
        }

        return $fileNames;
    }
}
