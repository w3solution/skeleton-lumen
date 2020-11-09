<?php

class UserTest extends TestCase{

    public function testUserLogin() {

        $response = $this->call('POST', '/login', [
            'email' => 'elric.metall@gmail.com',
            'password' => 'haunted27',
        ]);

        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testGetLocation() {

        $this->get("localizations", []);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'id',
                    'user_id', 
                    'latitude', 
                    'longitude'
                ]
            ],
            'meta' => [
                '*' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ]
            ]
        ]);

    }

}