<?php

namespace App\Domain\UseCases\Houses;

use App\Domain\Repositories\HousesRepository;
use App\Domain\Repositories\LordRepository;

class CreateHouseUseCase{

    protected $housesRepository;
    protected $lordsRepository;

    public function __construct(HousesRepository $housesRepository, LordRepository $lordRepository){

        $this->housesRepository = $housesRepository;
        $this->lordsRepository = $lordRepository;
    }

    public function handle(array $data){

        if(!key_exists('titles', $data['lord'])){
            $data['lord']['titles'] = null;
        }

        if(!key_exists('aliases', $data['lord'])){
            $data['lord']['aliases'] = null;
        }

        $house = $this->housesRepository->create($data);

        $data['lord']['house_id'] = $house->id;

        $this->lordsRepository->create($data);

        $response = [
            'message' => 'Casa criada com sucesso!',
            'house_id' => $house->id,
            'house' => $house
        ];
        
        return $response;
        
    }
}