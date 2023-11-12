<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'm_id',
        'user_id',
        'payment_id',
        'withdrawal_id',
        'amount',
        'type',
        'currency',
        'confirmed',
        'canceled',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'confirmed' => 'boolean',
        'canceled' => 'boolean',
    ];


    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'm_id');
    }

    /**
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }

    /**
     * @return HasOne
     */
    protected function withdrawal(): HasOne
    {
        return $this->hasOne(Withdrawal::class, 'id', 'withdrawal_id');
    }

    protected function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function response(): HasOne
    {
        return $this->hasOne(ClientResponse::class, 'transaction_id');
    }

}
