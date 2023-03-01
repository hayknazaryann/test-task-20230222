<?php

namespace Tests\Unit;

use App\Models\User;
use Symfony\Component\Console\Command\Command;
use Tests\TestCase;

class JsonDataTest extends TestCase
{

    public function testGenerateToken()
    {
        $response = $this->artisan('generate:token --username=testuser1 --password=A4xurzLV');
        $response->assertExitCode(Command::SUCCESS);
    }

    public function testIndex()
    {
        $this->assignUser();
        $response = $this->get('/');
        $this->assertEquals(200, $response->status());
    }


    public function testCreateUpdate()
    {
        $user = $this->assignUser();
        $tokenData = $user->tokens()->first();
        $data = [
            "title" => "Main title",
            "type" => "Main type",
            "items" => [
                "item 1" => [
                    "title" => "Item 1 title",
                    "type" => "Item 1 type",
                    "items" => [
                        "item 1" => [
                            "title" => "Item 1-1 title",
                            "type" => "Item 1-1 type"
                        ],
                        "item 2" => [
                            "title" => "Item 1-2 title",
                            "type" => "Item 1-2 type"
                        ]
                    ]
                ],
                "item 2" => [
                    "title" => "Item 2 title",
                    "type" => "Item 2 type",
                    "items" => [
                        "item 1" => [
                            "title" => "Item 2-1 title",
                            "type" => "Item 2-1 type"
                        ],
                        "item 2" => [
                            "title" => "Item 2-2 title",
                            "type" => "Item 2-2 type"
                        ],
                        "item 3" => [
                            "title" => "Item 2-3 title",
                            "type" => "Item 2-3 type"
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->json('POST', '/json/create', ['data' => json_encode($data)], ['USER-TOKEN' => $tokenData->token, 'HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $user = $this->assignUser();
        $tokenData = $user->tokens()->first();
        $jsonData = $user->jsonData()->orderBy('id','DESC')->first();
        $data = [
            "title" => "Main title",
            "type" => "Main type",
            "items" => [
                "item 1" => [
                    "title" => "Item 1 title",
                    "type" => "Item 1 type",
                    "items" => [
                        "item 1" => [
                            "title" => "Item 1-1 title",
                            "type" => "Item 1-1 type"
                        ],
                        "item 2" => [
                            "title" => "Item 1-2 title",
                            "type" => "Item 1-2 type"
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->json('POST', '/json/update', ['data' => json_encode($data), 'code' => $jsonData->code], ['USER-TOKEN' => $tokenData->token, 'HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response->assertStatus(200);
    }

    public function testDelete()
    {
        $user = $this->assignUser();
        $jsonData = $user->jsonData()->orderBy('id','DESC')->first();
        $response = $this->delete('/json/delete/' . $jsonData->code);
        $this->assertDatabaseMissing('json_data', [
            'code' => $jsonData->code
        ]);
    }

    public function assignUser()
    {
        $user = User::where(['username' => 'testuser1'])->first();
        $this->actingAs($user);
        return $user;
    }





}
