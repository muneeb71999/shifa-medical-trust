<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenNumber extends Model
{
    protected $fillable = ['employee_id'];
    public function doctor()
    {
        // $this->token->update(['token_number' => 'token_number + 1']);
        return $this->belongsTo(Employees::class, 'employee_id', 'id');
    }
}
