<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
   protected $fillable = ['cnpj', 'name', 'url', 'email', 'logo', 'active', 'subscription', 'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended'];

    //pegar todos os users relacionados a esse tenant
    // um tenant tem muitos usuários
   public function  users(){
       return $this->hasMany(User::class);
   }


   // retorna qual  plano o tenant tem cadastrado
   // uma empresa (tenant) só tem um plano
    public function  plan(){
       return $this->belongsTo(Plan::class);
   }
}
