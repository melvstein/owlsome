<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->create([
            'accountId' => "OS-000000001",
            'role' => "Admin",
            'firstName' => 'Melvin Justine',
            'middleName' => 'Lisay',
            'lastName' => 'Bayogo',
            'contactNumber' => '09560627650',
            'email' => 'owlsome2021@gmail.com',
            'address' => 'Type B NBP, Poblacion, Muntinlupa City',
            'city' => 'Muntinlupa City',
            'password' => Hash::make("admin0424"),
        ]);
    }
}
