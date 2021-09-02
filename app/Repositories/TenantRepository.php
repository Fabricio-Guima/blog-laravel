<?php

namespace App\Repositories;

use App\repositories\Contracts\TenantRepositoryInterface;
use App\Models\Tenant;

class TenantRepository implements TenantRepositoryInterface
{
	protected $entity;
	
	public function __construct(Tenant $tenant)
	{
		$this->entity = $tenant;
	}
	public function getAllTenants(int $per_page){

		return $this->entity->paginate($per_page);
	}

	public function getTenantByUuid(string $uuid) {

		return $this->entity->where('uuid', $uuid)->first();
	}

	
}