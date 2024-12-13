<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emission extends Model
{
    protected $guarded = ['id_emisson'];
    protected $table = 'emitter';
    protected $primaryKey = 'id_emission';
    public $timestamps = false;
}
