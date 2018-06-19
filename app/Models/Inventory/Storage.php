<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'storage';

    public function material(){
        return $this->belongsTo('App\Models\Inventory\Material');
    }
}
