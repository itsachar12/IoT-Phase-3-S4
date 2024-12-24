<?php

namespace App\Console\Commands;

use App\Models\Summary;
use App\Models\Appliances;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateApplianceSummary extends Command
{

    protected $signature = 'summary:buat-summary-auto';
    protected $description = 'Membuat summary seluruh appliance setiap 5 menit';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // mengambil semua data appliance
        $appliances = Appliances::all();

        foreach ($appliances as $app) {

            $app->summaries()->create(
                [
                    'id_appliances' => $app->id_appliances,
                    'total_usage_time' => $app->usage_time,
                    'total_power' => $app->total_power,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]

            );
        }

        $this->info('Appliance summaries added successfully!');
    }
}
