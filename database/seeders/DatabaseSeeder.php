<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'=>'Admin',
                'roleId' => 1,
                'contactNo'=> '90000000000',
                'email' =>'admin@example.com',
                'password'  => Hash::make('admin'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'lastLogin'  => Carbon::now()
            ],

            [
                'name'=>'User',
                'roleId' => 2,
                'contactNo'=> '90000000001',
                'email' =>'user01@example.com',
                'password'  => Hash::make('user'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'lastLogin'  => Carbon::now()
            ],
            [
                'name'=>'User',
                'roleId' => 2,
                'contactNo'=> '90000000002',
                'email' =>'user02@example.com',
                'password'  => Hash::make('user'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'lastLogin'  => Carbon::now()
            ],


        ]);
    }
}
 