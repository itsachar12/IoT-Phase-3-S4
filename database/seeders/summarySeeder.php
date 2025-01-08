<?php

namespace Database\Seeders;

use App\Models\Summary;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class summarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Summary::factory(10)->create();
    }
}
