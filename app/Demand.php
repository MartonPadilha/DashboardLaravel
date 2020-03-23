<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $table = 'demands';

    public function products(){
        return $this->belongsToMany(Product::class, 'product_demand', 'id_demand', 'id_product');//Classe a se relacionar, tabela pivo, fk local da tabela pivo, fk da tabela que se relaciona na tabela pivo
    }
}
