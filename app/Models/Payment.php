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
        'currency',
        'order',
        'payment_system',
        'pay_screen',
        'moderation',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'moderation' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'm_id', 'm_id');
    }




}
