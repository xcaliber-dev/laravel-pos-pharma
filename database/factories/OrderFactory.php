<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        return [
            'user_id' => User::inRandomOrder()->where('role_id', 2)->first()->id,
            'product_id' => $product->id,
            'is_sold' => 1,
            'org_price' => $product->price,
            'sold_price' => $product->price,
            'total_price' => 100,
            'quantity' => rand(1, 10),
        ];
    }
}
