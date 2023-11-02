<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'm_id',
        'amount',
        'payment_system',
        'pay_screen',
        'currency',
        'moderation',
    ];

    protected $casts = [
        'moderation' => 'boolean',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'm_id', 'm_id');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'p_id', 'id');
    }
}
