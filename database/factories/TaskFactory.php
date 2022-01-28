<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $price = [200, 500, 800, 1500];
        return [
            'name'        => $this->faker->sentence(),
            'description' => $this->faker->sentences( rand( 2, 5 ), true ),
            'price'       => $price[rand( 0, 3 )],
            'client_id'   => Client::all()->random()->id,
            'user_id'     => User::all()->random()->id,
        ];
    }
}
