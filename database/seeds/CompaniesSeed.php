<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CompaniesSeed extends Seeder
{
    public $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Company::create([
            'name' => $this->faker->name,
            'email' => $this->faker->email.'@gmail.com',
            'password' => bcrypt('123456'),
            'website' => $this->faker->company,
            'plan' => 'monthly',
        ]);
    }
}