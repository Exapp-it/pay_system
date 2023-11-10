<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentSystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Testing Card',
            'desc' => 'Card Testiong',
            'url' => 'http://examlpe.com',
            'currency' => 'USD',
            'logo' => 'Card.png',
        ];
    }
}
