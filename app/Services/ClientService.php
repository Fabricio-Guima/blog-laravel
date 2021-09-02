<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository){

       $this->clientRepository = $clientRepository;
        
    }

	public function createNewClient(array $data){

		return $this->clientRepository->createNewClient($data);

	}

   

}