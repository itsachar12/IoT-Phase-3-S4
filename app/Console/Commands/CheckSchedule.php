<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use App\Models\Appliances;
use App\Services\MqttService;
use Carbon\Carbon;


class CheckSchedule extends Command
{
    protected $signature = 'schedule:check';
    protected $description = 'Cek jadwal appliances dan kirim perintah jika waktu selesai';

   public function handle(MqttService $mqtt)
{
    $now = Carbon::now();
    $this->info("Schedule checker running at: $now");

    $schedules = Schedule::where('status', 'Active')->get();

    foreach ($schedules as $schedule) {
        $appliance = Appliances::find($schedule->id_appliances); // perbaikan nama kolom

        if (!$appliance) continue;

        $start = Carbon::parse($schedule->time_start);
        $end = Carbon::parse($schedule->time_end);

        // Jika sekarang di antara time_start dan time_end -> nyalakan
        if ($now->between($start, $end) && $appliance->status !== 'Active') {
            $appliance->update(['status' => 'Active']);
            $mqtt->publish($appliance->mqtt_topic . ' on');

            $this->info("ON: {$appliance->name} dinyalakan via MQTT pada {$now}");
        }

        // Jika sekarang sudah lewat time_end -> matikan
        if ($now->greaterThanOrEqualTo($end) && $appliance->status !== 'Inactive') {
            $appliance->update(['status' => 'Inactive']);
            $schedule->update(['status' => 'Inactive']); // matikan schedule jika tidak ingin lanjut

            $mqtt->publish($appliance->mqtt_topic . ' off');

            $this->info("OFF: {$appliance->name} dimatikan via MQTT pada {$now}");
        }
    }

    return 0;
}

}
