<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title',
        'base_url', 'success_url',
        'fail_url', 'handler_url',
        'm_id', 'm_key',
        'is_active', 'moderation',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'moderation' => 'boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function scopeWithModeration($query)
    {
        return $query->where('moderation', true);
    }


}
