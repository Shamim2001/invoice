<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name'      => $this->faker->name(),
            'username'  => $this->faker->unique()->userName(),
            'email'     => $this->faker->unique()->safeEmail(),
            'phone'     => $this->faker->phoneNumber,
            'country'   => $this->faker->country,
            'thambnail' => 'https://picsum.photos/300?random=' . rand( 1, 22334 ),

        ];
    }
}
