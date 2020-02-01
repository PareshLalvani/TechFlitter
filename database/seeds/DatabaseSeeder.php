<?php

use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
		foreach (range(1,3000) as $index) {
	        User::create([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'password' => bcrypt('secret'),
                'phone' => $faker->phoneNumber,
                'company' => $faker->company,
	        ]);
		}
    }
}
