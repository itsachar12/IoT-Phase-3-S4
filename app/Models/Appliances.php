<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

