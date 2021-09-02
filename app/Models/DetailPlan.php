<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    protected $table = 'details_plan';

    protected $fillable = ["name"];

     public function plan(){
         //nao precisei importar plan prq ele já está na mesma pasta que  detailplan
        return $this->belongsTo(Plan::class);
    }

   
}
