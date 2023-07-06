<?php

namespace Tests\Feature\Api\Endpoins;

use App\Models\Houses;
use App\Models\Lords;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class HousesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_all_houses(){

        $response = $this->get('/api/admin/houses');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'region',
                        'founded_in',
                        'current_lord',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'lords' => [
                            '*' => [
                                'id',
                                'name',
                                'gender',
                                'titles',
                                'aliases',
                                'interpretedBy',
                                'seasons_appeared',
                                'house',
                                'created_at',
                                'updated_at',
                                'deleted_at',
                            ]
                        ]
                    ]
                ]
            ]);
    
    }

    public function test_create_house(){

        $payload = [
            "name" => "House Targaryen of King's Landing",
            "region" => "The Crownlands",
            "founded_in" => "House Targaryen: >114 BCHouse Targaryen of King's Landing:1 AC",
            "lord" => [
                "name" => "Daenerys Targaryen",
                "gender" => "Female",
                "interpretedBy" => "Emilia Clark",
                "titles" => [
                    "Queen of Meereen",
                    "Princess of Dragonstone"
                ],
                "aliases" => [
                    "Dany",
                    "Mother of Dragons"
                ],
                "seasons_appeared" => [
                    "Season 1",
                    "Season 2",
                    "Season 3",
                    "Season 4",
                    "Season 5",
                    "Season 6"
                ]
            ]
        ];

        $this->json('post', 'api/admin/houses', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "message",
                    "house_id",
                    "house" => [
                        "name",
                        "region",
                        "founded_in",
                        "current_lord",
                        "updated_at",
                        "created_at",
                        "id"
                    ]
                ]
            ]);
    }

    public function test_update_house(){

        $house = [
            "name" => "House Teste",
            "region" => "The Test State",
            "founded_in" => "2023 AC",
            "lord" => [
                "name" => "Targaryen Daenerys",
                "gender" => "Female",
                "interpretedBy" => "Emilia Clark",
                "titles" => [
                ],
                "aliases" => [
                ],
                "seasons_appeared" => [
                    "Season 1",
                    "Season 2",
                    "Season 3"
                ]
            ]
        ];

        $this->json('put', "api/admin/houses/3", $house)
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "message"
                ]
            ]);
    }

    public function test_destroy_house(){

        $dataHouse = [
            "name" => "House Targaryen of King's Landing",
            "region" => "The Crownlands",
            "founded_in" => "House Targaryen: >114 BCHouse Targaryen of King's Landing:1 AC",
            "current_lord" => "Daenerys Targaryen"
        ];

        $house = Houses::create($dataHouse);

        $dataLord = [
            "name" => "Daenerys Targaryen",
            "gender" => "Female",
            "interpretedBy" => "Emilia Clark",
            "titles" => [
                "Queen of Meereen",
                "Princess of Dragonstone"
            ],
            "aliases" => [
                "Dany",
                "Mother of Dragons"
            ],
            "seasons_appeared" => [
                "Season 1",
                "Season 2",
                "Season 3",
                "Season 4",
                "Season 5",
                "Season 6"
            ],
            "house" => $house->id
        ];

        Lords::create($dataLord);

        $this->json('delete', "/api/admin/houses/$house->id")
            ->assertStatus(200);
    }

    public function test_return_error_field_missing_create_and_update_house(){

        $this->json('post', '/api/admin/houses', [])
            ->assertStatus(422);

        $this->json('put', '/api/admin/houses/4', [])
            ->assertStatus(422);

    }



    
}
