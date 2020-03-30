<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    public function demands(){
        return $this->hasMany(Demand::class, 'id_client', 'id');
    }
}
