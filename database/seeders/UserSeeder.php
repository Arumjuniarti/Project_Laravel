<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
            user::create([
                'name'      => 'aldy',
                'email'     => 'aldy69@gmail.com',    
                'password'  => Hash::make('inipassword')
            ]);

            for ($i = 1; $i <= 50; $i++) {
                User::create([
                    'name'      => $faker->name,
                    'email'     => $faker->unique()->safeEmail,
                    'password'  => Hash::make('123')  // Atur password ke '123'
                ]);
            }

            
        
    }
}


