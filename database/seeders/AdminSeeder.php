<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seeder storing admin cred info.
     *
     * @return void
     */
    public function run()
    {
        // Storing password in hashed format
        $hashed_pass = Hash::make("password");
        DB::table('admins')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin@assettracker.com',
                'password' => $hashed_pass
            ]
        );
    }
}
