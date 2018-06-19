<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $fillable = ['material_id','unit','quantity','unit_price','percentage','unit_price_discount','sub_total','iva','total'];

    public function order(){
        return $this->belongsTo('App\Models\Inventory\Order');
    }

    public function material(){
        return $this->belongsTo('App\Models\Inventory\Material');
    }
}
