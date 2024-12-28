<?php

namespace App\Console\Commands;

use Carbon\Carbon;
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
        $today = Carbon::now()->startOfDay();
        $appliances = Appliances::all();
        // $summaries = Summary::all();

        foreach ($appliances as $app) {

            $summary = Summary::where('id_appliances', $app->id_appliances)
            ->whereDate('created_at', $today)->first();

            if($summary){
                $summary->update([
                    'total_usage_time' =>$app->usage_time,
                    'total_power' => $app->total_power,
                    'updated_at' => now(),
                ]);
            } else {
                Summary::create([
                    'id_appliances' => $app->id_appliances,
                    'total_usage_time' => $app->usage_time,
                    'total_power' => $app->total_power,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->info('Appliance summaries added successfully!');
    }
}
