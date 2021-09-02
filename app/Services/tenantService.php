<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantService {

	private $plan, $data = [];
	private $repository;

	

	public function __construct(TenantRepositoryInterface $repository) {

		$this->repository = $repository;

	}

	public function getAllTenants(int $per_page) {

		return $this->repository->getAllTenants($per_page);
	}

	public function getTenantByUuid(string $uuid) {

		return $this->repository->getTenantByUuid($uuid);
	}

	public function make(Plan $plan, array $data) {
		
		$this->plan = $plan;
		$this->data = $data;

		$tenant = $this->storeTenant();
		 
		$user = $this->storeUser($tenant);

		return $user;

        
	}

	public function storeTenant() {

		$data = $this->data;

		return $this->plan->tenants()->create([
			//crio o uuid e a url única no observer
			'cnpj' => $data['cnpj'],           
            'name' => $data['empresa'],           
            'email' => $data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDay(7),
		]);
		

	}

	public function storeUser($tenant) {

		$data = $this->data;

		 $user = $tenant->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
         ]);

		 return $user;

	}

}