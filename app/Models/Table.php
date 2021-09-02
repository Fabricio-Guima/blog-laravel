<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Table extends Model
{
    use TenantTrait;

    protected $fillable = ['identify', 'description'];
}
