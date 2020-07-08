<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    protected $fillable = ['total_price'];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'invoice_id', 'id');
    }
}
