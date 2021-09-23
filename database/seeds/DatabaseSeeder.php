<?php

use Illuminate\Database\Seeder;
use  \Database\Seeders\{
    RoleSeeder,
    ProductSeeder,
    SupplierSeeder,
    UsersSeeder,
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            SupplierSeeder::class,
            UsersSeeder::class,
            ProductSeeder::class,
        ]);
    }
}

