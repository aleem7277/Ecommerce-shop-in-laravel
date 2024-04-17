<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Gallery;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        // User::factory(10)->create();
        Product::truncate();
        Schema::enableForeignKeyConstraints();
       
       Product::factory(10)->create();
       Gallery::factory(10)->create();
    }
}
