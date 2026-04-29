<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'purchase_id',
        'current_period_start',
        'current_period_end',
        'status',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
