<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_id',
        'amount',
        'currency',
        'confirmed',
        'canceled',
    ];

    protected $casts = [
        'confirmed' => 'boolean',
        'canceled' => 'boolean',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'p_id', 'id');
    }
}
