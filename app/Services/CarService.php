<?php

namespace App\Services;

use App\Models\Car;
use App\Services\MediaService;

class CarService
{
    private $mediaService;

    public function __construct(MediaService $mediaService){
        $this->mediaService = $mediaService;
    }
    public function create(array $data)
    {
        $car = Car::create([
            'brand' => $data['brand'],
            'model' => $data['model'],
            'registration_date' => $data['registration_date'],
            'engine_size' => $data['engine_size'],
            'price' => $data['price'],

        ]);
        $file = $data['image'];
        $image = $this->mediaService->carCreate($file, $car->id);

    }

    public function updateCar($car, array $data)
    {
        if (!isset($data['image'])){
            $data['image'] = $car->image;
        }

        return $car->update([
            'brand' => $data['brand'],
            'model' => $data['model'],
            'registration_date' => $data['registration_date'],
            'engine_size' => $data['engine_size'],
            'price' => $data['price'],
            'image' => $data['image'],

        ]);
    }



}
