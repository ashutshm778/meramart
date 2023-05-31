<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FeatureActivationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::Class);
        $this->call(CreateAdminUserSeeder::Class);
        $this->call(ColorSeeder::Class);
        $this->call(FeatureActivationSeeder::Class);
    }
}
