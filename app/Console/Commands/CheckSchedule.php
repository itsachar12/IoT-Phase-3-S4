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

    public function handle()
    {
        $now = Carbon::now();

        // Ambil semua schedule yang aktif
        $schedules = Schedule::where('status', 'Active')->get();

        foreach ($schedules as $schedule) {
            $endTime = Carbon::parse($schedule->time_end);

            // Jika waktu sekarang sudah lewat dari time_end
            if ($now->greaterThanOrEqualTo($endTime)) {
                $appliance = Appliances::find($schedule->id_appliance);

                // Pastikan appliance masih aktif
                if ($appliance && $appliance->status === 'Active') {
                    // Update DB: ubah status jadi Inactive
                    $appliance->update(['status' => 'Inactive']);
                    $schedule->update(['status' => 'Inactive']);

                    // Kirim perintah via MQTT
                    $mqtt = new MqttService();
                    $mqtt->publish($appliance->mqtt_topic . ' off');

                    $this->info("{$appliance->name} dimatikan via MQTT pada {$now}");
                }
            }
        }

        return 0;
    }
}
