<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call([
            UserPrefixSeeder::class,
            UserPositionSeeder::class,
            UserSeeder::class,
            CarSeeder::class,
            SqlThailandProvinceSeeder::class,
        ]);
    }
}
