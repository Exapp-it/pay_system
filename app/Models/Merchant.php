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
        'm_id',
        'm_key',
        'is_active',
        'moderation',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_active' => 'boolean',
        'moderation' => 'boolean',
        'm_key' => 'encrypted',
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
     * @param $query
     * @return mixed
     */
    public function scopeActiveAndModerated($query): mixed
    {
        return $query->where('moderation', true)
            ->where('is_active', true);
    }


}
