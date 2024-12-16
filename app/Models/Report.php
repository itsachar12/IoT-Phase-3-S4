<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $guarded = ['id_report'];
  protected $table = 'reports';
  protected $primaryKey = 'id_report';
  public $timestamps = false;

}
