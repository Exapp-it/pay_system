<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PSInfo extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'ps_id',
        'title',
        'value',
        'activated',
    ];


    /**
     * @var string[]
     */
    protected $casts = [
        'activated' => 'boolean',
    ];


    /**
     * @return BelongsTo
     */
    public function paymentSystem(): BelongsTo
    {
        return $this->belongsTo(PaymentSystem::class, 'ps_id');
    }

}
