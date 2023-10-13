<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'brand',
        'model',
        'registration_date',
        'engine_size',
        'price',
        'image',
    ];



    /**
     * Get the engine used to index the model.
     */

    public function getImageAttribute(){
        return $this->attributes['image'];
    }

    public function getFullImageUrlAttribute(){
        if (!isset($this->featured_image)){
            return  '';
        }
        return asset('storage/cars/'.$this->featured_image->hash_name);
    }

    public function images(){
        return $this->hasMany(Media::class, 'car_id');
    }

    public function getFeaturedImageAttribute(){
        return $this->images()->first();
    }

}
