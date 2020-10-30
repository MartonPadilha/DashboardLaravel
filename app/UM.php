<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UM extends Model
{
    protected $table = "um";

    public function products(){
        return $this->hasMany(Product::class, 'id_um', 'id');
    }
}
