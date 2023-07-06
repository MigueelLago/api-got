<?php

namespace App\Domain\UseCases\Houses;

use App\Domain\Repositories\HousesRepository;
use App\Domain\Repositories\LordRepository;

class UpdateHouseUseCase{

    protected $housesRepository;
    protected $lordsRepository;

    public function __construct(HousesRepository $housesRepository, LordRepository $lordRepository){
        
        $this->housesRepository = $housesRepository;
        $this->lordsRepository = $lordRepository;
    }

    public function handle(array $data, int $id){
        
        if(!key_exists('titles', $data['lord'])){
            $data['lord']['titles'] = null;
        }

        if(!key_exists('aliases', $data['lord'])){
            $data['lord']['aliases'] = null;
        }

        $house = $this->housesRepository->findById($id);
        
        if($house != null){

            $this->housesRepository->update($data, $id);

            $data['lord']['house_id'] = $house->id;

            $this->lordsRepository->update($data);

            $response = [
                'message' => 'Casa atualizada com sucesso!'
            ];

            return $response;

        }else{

            $response = [
                'message' => 'Não encontramos nenhum registro com esse ID.'
            ];

            return $response;
        }

    }
}