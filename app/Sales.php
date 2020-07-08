<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Sales extends Model
{
    protected $fillable = ['medicine_id', 'unit_price', 'quantity', 'invoice_id', 'user_id'];

    protected $guarded = false;

    public function medicine()
    {
        return $this->hasOne(Medicines::class, 'id', 'medicine_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
