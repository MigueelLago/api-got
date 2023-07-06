<?php

namespace App\Domain\UseCases\Houses;

use App\Domain\Repositories\HousesRepository;

class GetHousesUseCase{

    protected $housesRepository;

    public function __construct(HousesRepository $housesRepository){
        
        $this->housesRepository = $housesRepository;
    }

    public function handle(array $query = []){
        
        return $this->housesRepository->get($query);
    }
}