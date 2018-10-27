<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients";
    protected $primaryKey = 'patient_id';
    public $incrementing = false;
    // protected $casts = [
    //     'patient_id' => 'integer',
    // ];
    protected $fillable = ['patient_id', 'name', 'address_line_1', 'address_line_2', 'address_line_3', 'nic', 'gender', 'birthday', 'contact_no', 'guardian_no'];
}   
