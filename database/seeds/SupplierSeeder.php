<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Supplier::factory(5)->create();

        $faker = Factory::create();
        $suppliers = ['Alibaba', 'Ali Express', 'Amazon', 'Awamedica'];
        foreach ($suppliers as $supplier) {
            Supplier::create([
                'name' => $supplier,
                'email' => $faker->email,
                'phone_number' => $faker->e164PhoneNumber,
                'address' => $faker->city,
            ]);
        }
    }
}
