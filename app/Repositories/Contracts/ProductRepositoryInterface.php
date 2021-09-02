<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
	public function getproductsByTenantId(int $idTenant, array $categories);

	 public function getProductByUrl(string $url);


	
}