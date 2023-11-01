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
        'base_url',    'success_url',
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


    public static function generateId()
    {
        $baseValue = time() * 1000;
        $randomDigits = mt_rand(1000, 9999);

        $baseValueString = strval($baseValue);
        $shuffledBaseValueString = str_shuffle($baseValueString);

        $uniqueId = substr(intval($shuffledBaseValueString) + $randomDigits, 0, 12);

        return (int) $uniqueId;
    }

    public static function generateKey()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Допустимые символы для ключа
        $key = '';

        for ($i = 0; $i < 32; $i++) {
            $key .= $characters[rand(0, strlen($characters) - 1)]; // Выбираем случайный символ из допустимых символов
        }

        return $key;
    }
}
