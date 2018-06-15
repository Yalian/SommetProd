<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function lines(){
        $this->hasMany('App\Models\Inventory\Line');
    }
}
