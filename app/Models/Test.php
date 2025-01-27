<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    public $attributes = [
        'title' => '',
        'description' => '',
        'price' => 0.0,
    ];
}
