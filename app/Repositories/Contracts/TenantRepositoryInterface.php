<?php

namespace App\repositories\Contracts;

interface TenantRepositoryInterface
{
	public function getAllTenants(int $per_page);

	public function getTenantByUuid(string $uuid);

}

