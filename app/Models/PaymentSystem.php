<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'activated',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'activated' => 'boolean',
    ];
}
