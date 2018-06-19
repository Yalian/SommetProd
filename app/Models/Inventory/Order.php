<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function lines(){
        return $this->hasMany('App\Models\Inventory\Line');
    }

    protected $fillable = ['guide','date','sub_total','discount','total', 'img_name'];
}
