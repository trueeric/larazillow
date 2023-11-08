<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // 建立Listing的(假)資料

        \App\Models\User::factory()->create([
            'name'     => 'Test1',
            'email'    => 'aa1@aa.com',
            'is_admin' => true,
        ]);
        \App\Models\User::factory()->create([
            'name'  => 'Test2',
            'email' => 'aa2@aa.com',
        ]);
        \App\Models\User::factory()->create([
            'name'  => 'Test3',
            'email' => 'aa3@aa.com',
        ]);
        // \App\Models\Listing::factory(20)->create();
        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 1,
        ]);
        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 2,
        ]);
        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 3,
        ]);

    }
}
