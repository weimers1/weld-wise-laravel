<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    /** @use HasFactory<\Database\Factories\TestFactory> */
    use HasFactory;

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
