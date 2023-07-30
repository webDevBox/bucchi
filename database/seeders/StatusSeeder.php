<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OutfitStatusType;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Fabric','Dying','Embr In','Embr Out','Tailor In',
        'Tailor Out','Checking','Photo','Packing','Completed'];
        foreach ($statuses as $status) {
            OutfitStatusType::updateOrCreate([
                'status' => $status
            ]);
        }
    }
}
