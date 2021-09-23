<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ar_SA');
        DB::table('users')->insert([
            'name' => 'basit',
            'email' => 'basit@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'image' => '/upload/users/no-image.png',
            'phone' => $faker->e164PhoneNumber,
            'alt_phone' => $faker->e164PhoneNumber,
            'address' => 'Erbil',
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        for ($i = 0; $i < 100; $i++) {
            User::firstOrcreate([
                'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'image' => '/upload/users/no-image.png',
                'phone' => $faker->e164PhoneNumber,
                'alt_phone' => $faker->e164PhoneNumber,
                'address' => $faker->streetAddress,
                'role_id' =>$faker->boolean?2:3,
            ]);
        }
    }
}
