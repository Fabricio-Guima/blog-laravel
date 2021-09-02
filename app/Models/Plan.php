<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = ["name",'url', 'price', 'description'];

    public function details(){

        //nao precisei importar detailplan prq ele já está na mesma pasta que plan
        return $this->hasMany(DetailPlan::class);
    }

    public function profiles(){
        return $this->belongsToMany(Profile::class);
    }

    //pega todos os tenants vinculados a este plano
    public function  tenants() {
        return $this->hasMany(Tenant::class);
    }

    public function search($search = null){

        $results = $this
                    ->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->paginate();

        return $results;

    }

    // profiles nao linkadas a este plano
    public function profilesAvailable($filter = null ) {
  
    $profiles = Profile::whereNotIn('profiles.id', function($query){
       $query->select('plan_profile.profile_id');
       $query->from('plan_profile');
       $query->whereRaw("plan_profile.plan_id={$this->id}");
    })->where( function ($queryFilter) use ($filter){
       if($filter){
          $queryFilter->where('profiles.name', 'LIKE',"%{$filter}%");
       }
    })->paginate();
   

    return $profiles;

}


}
