<?php

namespace App\Models;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    public function shipment()
    {
        return $this->hasOne('App\Models\Shipment');
    }
}
