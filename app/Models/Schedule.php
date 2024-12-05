<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $table = 'schedule';
    protected $primaryKey = 'id_schedule';
    public $timestamps = false;

    public function appliance()
    {
        return $this->belongsTo(appliances::class);
    }


}
