<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'id' => 1,
            'name' => 'authorized',
        ]);
        Status::create([
            'id' => 2,
            'name' => 'decline',
        ]);
        Status::create([
            'id' => 3,
            'name' => 'refunded',
        ]);
    }
}
