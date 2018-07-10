<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    public function product(){
        return $this->hasMany('App\Models\Administration\Product');
    }
}
