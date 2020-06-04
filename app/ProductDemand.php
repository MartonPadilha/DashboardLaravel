<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDemand extends Model
{
    protected $table = "product_demands";

    // public function demands(){
    //     return $this->hasMany(Demand::class, 'id_demand')
    // }
}
