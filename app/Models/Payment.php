<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'm_id',
        'amount',
        'amount_default_currency',
        'currency',
        'order',
        'username',
        'payment_system',
        'pay_screen',
        'approved',
        'canceled',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'approved' => 'boolean',
        'canceled' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'm_id', 'm_id');
    }

    /**
     * @return BelongsTo
     */
    public function system(): BelongsTo
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_system');
    }

    /**
     * @return HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'payment_id');
    }
}
