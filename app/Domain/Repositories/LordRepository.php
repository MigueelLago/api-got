<?php

namespace App\Domain\Repositories;

use App\Models\Lords;

class LordRepository{

    private $lordsModel;

    public function __construct(Lords $lords){
        
        $this->lordsModel = $lords;
    }

    public function create(array $data){
        
        return $this->lordsModel
            ->create([
                'name' => $data['lord']['name'],
                'house' => $data['lord']['house_id'],
                'seasons_appeared' => $data['lord']['seasons_appeared'],
                'gender' => $data['lord']['gender'],
                'interpretedBy' => $data['lord']['interpretedBy'],
                'titles' => $data['lord']['titles'],
                'aliases' => $data['lord']['aliases']
            ]);
    }

    public function update(array $data){

        return $this->lordsModel
            ->where('id', $data['lord']['house_id'])
            ->update([
                'name' => $data['lord']['name'],
                'seasons_appeared' => $data['lord']['seasons_appeared'],
                'gender' => $data['lord']['gender'],
                'interpretedBy' => $data['lord']['interpretedBy'],
                'titles' => $data['lord']['titles'],
                'aliases' => $data['lord']['aliases']
            ]);
    }

    public function delete(int $houseId, int $lordId){

        return $this->lordsModel
            ->where('house', $houseId)
            ->where('id', $lordId)
            ->delete();
    }
}