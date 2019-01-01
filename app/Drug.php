<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $table = "drugs";
    protected $primaryKey = 'drug_id';

    protected $fillable = [
        'name', 'brand', 'quantity', 'expire_date', 'supplier_email'
    ];

}
