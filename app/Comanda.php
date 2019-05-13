<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $fillable = ['medicament' , 'cantitate' , 'idSectie', 'status'];

    public function sectie(){
        return $this->belongsTo('App\Sectie');
    }
}
