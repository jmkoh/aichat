<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function purchasetransactions() 
    {
        return $this->hasMany(PurchaseTransaction::class, 'customer_id');
    }

}
