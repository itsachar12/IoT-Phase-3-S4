<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\DefaultAttributes\ApplyDefaultAttributesProcessor;

class Summary extends Model
{
    protected $table = 'summary';
    protected $primaryKey = 'id_summary';
    protected $guarded = ['id_summary'];
    public $timestamps = true;
    use HasFactory;


    public function appliance()
    {
        return $this->belongsTo(Appliances::class, 'id_appliances');
    }

}


