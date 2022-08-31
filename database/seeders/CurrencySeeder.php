<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'SAR',
        ]);
        Currency::create([
            'name' => 'USD',
        ]);
        Currency::create([
            'name' => 'EGP',
        ]);
        Currency::create([
            'name' => 'AED',
        ]);
        Currency::create([
            'name' => 'EUR',
        ]);
    }
}
