<?php

namespace Database\Seeders;

use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Team::truncate();

        $team = [
            [
                'name' => 'banglore',
                'logo' => 'images/team1.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'mumbai',
                'logo' => 'images/team2.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [
                'name' => 'chennai',
                'logo' => 'images/team3.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'gujarat',
                'logo' => 'images/team4.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'delhi',
                'logo' => 'images/team5.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'laucknow',
                'logo' => 'images/team6.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'haryana',
                'logo' => 'images/team7.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'rajasthan',
                'logo' => 'images/team8.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'punjab',
                'logo' => 'images/team9.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'himachal',
                'logo' => 'images/team10.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'kerla',
                'logo' => 'images/team11.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'hydrabad',
                'logo' => 'images/team12.jpg',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        Team::insert($team);
    }
}
