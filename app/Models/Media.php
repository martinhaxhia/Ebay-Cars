<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'car_id',
        'user_id',
        'name',
        'hash_name',
        'mimes',
        'path',
    ];
    /**
     * @var mixed
     */


}
