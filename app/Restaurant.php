<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

    protected $fillable = [
        'shop_name', 'url', 'image_url', 'tel', 'address', 'access', 'open_time', 'holiday'
    ];


}
