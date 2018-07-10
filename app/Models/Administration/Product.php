<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function material(){
        return $this->belongsToMany('App\Models\Inventory\Material');
    }

    public function contract(){
        return $this->belongsTo('App\Models\Administration\Contract');
    }
}
