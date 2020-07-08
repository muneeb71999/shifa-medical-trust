<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    protected $fillable = ['name', 'quantity', 'unit_price'];

    // public function sales()
    // {
    //     return $this->belongsToMany(Sales::class, 'sales', 'medicine_id');
    // }
}
