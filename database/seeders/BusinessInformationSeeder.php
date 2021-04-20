<?php

namespace Database\Seeders;

use App\Models\BusinessInformation;
use Illuminate\Database\Seeder;

class BusinessInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businessInformation = new BusinessInformation();
        $businessInformation->create([
            'name' => 'Owlsome',
            'email' => 'owlsome2021@gmail.com',
            'contactNumber' => '09560627650',
            'address' => 'Blk 13 Lot 26 Ivory St. Newton Heights Subdivision Brgy. San Francisco Halang, Biñan Laguna',
            'city' => 'Biñan City',
            'google_map_src' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1932.8053295634606!2d121.05875040058002!3d14.334033744315663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d74056aaaaab%3A0x132a30e1ddc9e917!2sNewton%20Heights%20Subdivision!5e0!3m2!1sen!2sph!4v1612706539132!5m2!1sen!2sph',
        ]);
    }
}
