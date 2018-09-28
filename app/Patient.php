<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients";
    protected $primaryKey = 'nic';
    public $incrementing = false;
    protected $fillable = ['nic', 'name', 'address_line_1', 'address_line_2', 'address_line_3', 'gender', 'birthday', 'contact_no', 'guardian_no'];
}
