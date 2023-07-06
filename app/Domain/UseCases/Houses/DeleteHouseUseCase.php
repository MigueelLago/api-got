<?php

namespace App\Domain\UseCases\Houses;

use App\Domain\Repositories\HousesRepository;
use App\Domain\Repositories\LordRepository;

class DeleteHouseUseCase{

    protected $housesRepository;
    protected $lordRepository;

    public function __construct(HousesRepository $housesRepository, LordRepository $lordRepository){
        
        $this->housesRepository = $housesRepository;
        $this->lordRepository = $lordRepository;
    }

    public function handle($id){
        
        $house = $this->housesRepository->findById($id);

        if($house == NULL){

            $response = [
                'message' => 'Não existe casa criada com esse ID.'
            ];

            return $response;
        }

        $this->housesRepository->delete($id);
        $this->lordRepository->delete($id, $house->lords[0]->id);

        $response = [
            'message' => 'Casa deletada com sucesso!'
        ];

        return $response;
    }
}