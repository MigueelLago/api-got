<?php

namespace App\Domain\Repositories;

use App\Models\Houses;
use Illuminate\Support\Arr;

class HousesRepository{

    private $houseModel;

    public function __construct(Houses $houses){
        
        $this->houseModel = $houses;
    }

    public function create(array $data){
        
        return $this->houseModel
            ->create([
                'name' => $data['name'],
                'region' => $data['region'],
                'founded_in' => $data['founded_in'],
                'current_lord' => $data['lord']['name']
            ]);
    }

    public function get(array $query){
        
        return $this->houseModel
            ->FilterByName(Arr::get($query, 'name'))
            ->FilterById(Arr::get($query, 'id'))
            ->with('lords')
            ->get();
    }

    public function findById(int $id){

        return $this->houseModel
            ->where('id', $id)
            ->first();
    }

    public function update(array $data, int $id){

        return $this->houseModel
            ->where('id', $id)
            ->update([
                'name' => $data['name'],
                'region' => $data['region'],
                'founded_in' => $data['founded_in'],
                'current_lord' => $data['lord']['name']
            ]);
    }

    public function delete(int $id){

        return $this->houseModel
            ->where('id', $id)
            ->delete();
    }
}