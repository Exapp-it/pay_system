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
        'p_id',
        'amount',
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
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'p_id', 'id');
    }
}
