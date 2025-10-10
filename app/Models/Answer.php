<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = [
        'question_id',
        'description',
        'order',
        'is_correct',
        'is_deleted'
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'is_deleted' => 'boolean'
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
