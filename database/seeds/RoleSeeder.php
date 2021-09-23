<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin','Cashier','Sale Representative'];

        foreach ($roles as $role){
            \App\Models\Role::create([
                'name'=> $role
            ]);
        }
    }
}
