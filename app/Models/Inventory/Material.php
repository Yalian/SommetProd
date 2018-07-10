<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    public function storage(){
        return $this->hasMany('App\Models\Inventory\Storage');
    }

    public function product(){
        return $this->belongsToMany('App\Models\Administration\Product')->withTimestamps();
    }


}
