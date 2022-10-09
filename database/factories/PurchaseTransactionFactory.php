<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseTransaction>
 */
class PurchaseTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'total_spent' => rand(1,100),
            'total_saving' => rand(1,100),
            'transaction_at' => $this->faker->dateTimeBetween('-3 month', '-1 day'),
        ];
    }
}
