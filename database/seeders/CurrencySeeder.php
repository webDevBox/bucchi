<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = ['PKR','USD','GBP','EUR','CAD','AUD'];
        foreach ($currencies as $currency) {
            Currency::updateOrCreate(['name' => $currency]);
        }
    }
}
