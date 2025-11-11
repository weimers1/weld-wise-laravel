<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    protected $fillable = [
        'test_token_id',
        'question_id',
        'answer_id',
    ];

    public function testToken(): BelongsTo
    {
        return $this->belongsTo(TestToken::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
