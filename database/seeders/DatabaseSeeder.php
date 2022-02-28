<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\invoice;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        User::create( [
            'name'      => 'Shamim Ahmed',
            'email'     => 'test@gmail.com',
            'company'   => 'pixCafe Network',
            'phone'     => '+8801887144113',
            'country'   => 'Bangladesh',
            'password'  => bcrypt( '123' ),
            'thumbnail' => 'https://picsum.phptos/300',
        ] );
        // User::create( [
        //     'name'      => ' demo ',
        //     'email'     => 'demo@gmail.com',
        //     'company'   => 'Demo Network',
        //     'phone'     => '187144113',
        //     'country'   => 'Bangladesh',
        //     'password'  => bcrypt( '123' ),
        //     'thumbnail' => 'https://picsum.phptos/300',
        // ] );

        Client::factory( 10 )->create();

        Task::factory( 30 )->create();

        invoice::factory( 10 )->create();
    }
}
