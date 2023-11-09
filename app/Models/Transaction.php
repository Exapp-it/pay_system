<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'm_id',
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

}
