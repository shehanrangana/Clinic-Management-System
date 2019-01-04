<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabReport extends Model
{
    protected $table = "lab_reports";
    protected $primaryKey = 'report_id';
    public $incrementing = false;
    // protected $fillable = ['report_id', 'patient_nic', 'test', 'file'];
}
