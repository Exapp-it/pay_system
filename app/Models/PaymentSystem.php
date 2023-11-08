<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentSystem extends Model
{
    use HasFactory;


    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'desc',
        'url',
        'logo',
        'currency',
        'activated',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'activated' => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function infos(): HasMany
    {
        return $this->hasMany(PSInfo::class, 'ps_id');
    }

    /**
     * @return HasMany
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class, 'payment_system');
    }
}
