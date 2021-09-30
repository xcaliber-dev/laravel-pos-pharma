<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'barcode'=> rand(1000000,9999999),
            'supplier_id' => Supplier::inRandomOrder()->first()->id,
            'price' => rand(1000, 100000),
            'stock' => rand(1, 100),
            'is_dept' => $this->faker->boolean ? 1 : 0,
            'expire_at' => $this->faker->boolean ? Carbon::today()->addMonth(rand(1, 6))->format('Y-m-d') :
                Carbon::today()->subMonth(rand(1,
                3))->format('Y-m-d')
        ];
    }
}
