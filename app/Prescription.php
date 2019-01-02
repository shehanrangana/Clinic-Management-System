<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = "prescriptions";
    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'patient_id', 'date', 'drug_name', 'quantity'
    ];
}
