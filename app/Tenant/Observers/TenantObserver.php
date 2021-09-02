<?php
namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver {

	 /**
     * Handle the plan "creating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
		//em vez de instanciar, faço com app que dá o bind e devolve um objeto desta classe
		$managerTenant= app(ManagerTenant::class);

        $model->tenant_id = $managerTenant->getTenantIdentify();
    }
}