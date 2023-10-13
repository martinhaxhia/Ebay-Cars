<?php

namespace App\Services;


use App\Models\Media;


class MediaService
{
    protected $path = 'public/cars';

    public function imageStore($file)
    {
        $file->store($this->path);

        return $file->hashName();

    }

    public function imageUpdate($file)
    {
        $image = $file->hashName();

        $file->storeAs($this->path , $image);

        return $image;
    }

    public function carCreate($file, $carId)
    {
        Media::create([
           'car_id'=> $carId,
           'name' => $file->getClientOriginalName(),
           'hash_name' => $file->hashName(),
           'mimes' => $file->getClientMimeType(),
           'path' => $file->getRealPath(),
       ]);

     return $this->imageStore($file);

   }
    public function userCreate($file, $userId)
    {
        Media::create([
            'user_id'=> $userId,
            'name' => $file->getClientOriginalName(),
            'hash_name' => $file->hashName(),
            'mimes' => $file->getClientMimeType(),
            'path' => $file->getRealPath(),
        ]);

        return $this->imageStore($file);

    }
}
