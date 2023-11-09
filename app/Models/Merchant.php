<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Merchant extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'base_url',
        'success_url',
        'fail_url',
        'handler_url',
        'balance',
        'percent',
        'm_id',
        'm_key',
        'approved',
        'rejected',
        'activated',
        'banned',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'm_key' => 'encrypted',
        'approved' => 'boolean',
        'rejected' => 'boolean',
        'activated' => 'boolean',
        'banned' => 'boolean',
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'm_id', 'm_id');
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'm_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeApprovedAndActivated($query): mixed
    {
        return $query->where('approved', true)
            ->where('activated', true)
            ->where('banned', false);
    }


}
