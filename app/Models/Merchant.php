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

    protected $casts = [
        'is_active' => 'boolean',
        'moderation' => 'boolean',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'm_id', 'm_id');
    }


    public function scopeActiveAndModerated($query)
    {
        return $query->where('moderation', true)
            ->where('is_active', true);
    }


}
