<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function demands(){
        return $this->belongsToMany(Demand::class, 'product_demand', 'id_product', 'id_demand');//Classe a se relacionar, tabela pivo, fk local da tabela pivo, fk da tabela que se relaciona na tabela pivo
    }
}
