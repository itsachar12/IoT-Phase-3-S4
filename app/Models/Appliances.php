<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appliances extends Model
{
    
    protected $table = 'appliances';
    protected $primaryKey = 'id_appliances';
    protected $guarded = ['start_time'];
    public $timestamps = false;


    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
    public function summaries()
    {
        return $this->hasMany(Summary::class, 'id_appliances');
    }

    public static function resetUsageTimeAtMidnight()
    {
        $now = Carbon::now();
        if ($now->hour == 00 && $now->minute == 00) {
            // Reset usage_time untuk semua appliance
            self::query()->update(['usage_time' => 0]);
        }
    }
}

