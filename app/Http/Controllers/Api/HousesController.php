<?php

namespace App\Http\Controllers\Api;

use App\Domain\UseCases\Houses\CreateHouseUseCase;
use App\Domain\UseCases\Houses\DeleteHouseUseCase;
use App\Domain\UseCases\Houses\GetHousesUseCase;
use App\Domain\UseCases\Houses\UpdateHouseUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateHousesRequest;
use App\Http\Requests\Api\IndexHousesRequest;
use App\Http\Requests\Api\UpdateHousesRequest;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    private $getHousesUseCase;
    private $createHouseUseCase;
    private $deleteHouseUseCase;
    private $updateHouseUseCase;

    public function __construct(GetHousesUseCase $getHousesUseCase, CreateHouseUseCase $createHouseUseCase,
    DeleteHouseUseCase $deleteHouseUseCase, UpdateHouseUseCase $updateHouseUseCase){
        
        $this->getHousesUseCase = $getHousesUseCase;
        $this->createHouseUseCase = $createHouseUseCase;
        $this->deleteHouseUseCase = $deleteHouseUseCase;
        $this->updateHouseUseCase = $updateHouseUseCase;
        
    }

    public function store(CreateHousesRequest $createHousesRequest){

        $data = $createHousesRequest->validated();
        
        try {
            
            $data = $this->createHouseUseCase->handle($data);

            return response()->json(compact('data'), 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => 'Não foi possível salvar a casa no banco de dados.',
                'error' => $th->getMessage()
            ], 500);
        }
        
    }

    public function index(IndexHousesRequest $indexHousesRequest){
        
        $query = $indexHousesRequest->validated();
        
        try {
            
            $data = $this->getHousesUseCase->handle($query);

            return response()->json(compact('data'), 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => 'Houve um erro ao tentar carregar as informações.',
                'error' => $th->getMessage()
            ], 500);
        }

    }

    public function update(UpdateHousesRequest $updateHousesRequest, $id){

        $data = $updateHousesRequest->validated();

        try {
            
            $data = $this->updateHouseUseCase->handle($data, $id);

            return response()->json(compact('data'), 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => 'Não foi possível atualizar as informações da casa no banco de dados.',
                'error' => $th->getMessage()
            ], 500);
        }

    }

    public function destroy($id){

        try {

            $house = $this->deleteHouseUseCase->handle($id);
            
            return response()->json(compact('house'), 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => 'Não foi possível deletar a casa no banco de dados.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
