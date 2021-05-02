<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PostIncidentTest extends TestCase
{

    /**
     * test a post incident.
     *
     * @return void
     */
    public function testPostIncident()
    {
        $response = $this->call(
            'POST',
            '/incidents',
            [
                'title' => 'incident title',
                'category' => 1,
                'location' => [
                    'latitude' => '12.9231501',
                    'longitude' => '74.7818517'
                ],
                'people' => [
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "witness"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ]
                ],
                "comments" => "This is a string of comments",
                "incidentDate" =>  "2020-09-01T13:26:00+00:00",
                "createDate" =>  "2020-09-01T13:32:59+01:00",
                "modifyDate" =>  "2020-09-01T13:32:59+01:00"
            ],
            ['HTTP_Authorization' => 'Bearer ' . $this->token()]
        );
        $this->assertEquals(200, $response->status());
    }

    public function testlocationValidation()
    {
        $response = $this->call(
            'POST',
            '/incidents',
            [
                'title' => 'incident title',
                'category' => 1,
                'people' => [
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "witness"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ]
                ],
                "comments" => "This is a string of comments",
                "incidentDate" =>  "2020-09-01T13:26:00+00:00",
                "createDate" =>  "2020-09-01T13:32:59+01:00",
                "modifyDate" =>  "2020-09-01T13:32:59+01:00"
            ],
            ['HTTP_Authorization' => 'Bearer ' . $this->token()]
        );
        $this->assertEquals(422, $response->status());
    }

    public function testCategoryIdRequire()
    {
        $response = $this->call(
            'POST',
            '/incidents',
            [
                'title' => 'incident title',
                'location' => [
                    'latitude' => '12.9231501',
                    'longitude' => '74.7818517'
                ],
                'people' => [
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "witness"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ]
                ],
                "comments" => "This is a string of comments",
                "incidentDate" =>  "2020-09-01T13:26:00+00:00",
                "createDate" =>  "2020-09-01T13:32:59+01:00",
                "modifyDate" =>  "2020-09-01T13:32:59+01:00"
            ],
            ['HTTP_Authorization' => 'Bearer ' . $this->token()]
        );
        $this->assertEquals(422, $response->status());
    }

    public function testCategoryIdInvalid()
    {
        $response = $this->call(
            'POST',
            '/incidents',
            [
                'title' => 'incident title',
                'category' =>'9',
                'location' => [
                    'latitude' => '12.9231501',
                    'longitude' => '74.7818517'
                ],
                'people' => [
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "witness"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ]
                ],
                "comments" => "This is a string of comments",
                "incidentDate" =>  "2020-09-01T13:26:00+00:00",
                "createDate" =>  "2020-09-01T13:32:59+01:00",
                "modifyDate" =>  "2020-09-01T13:32:59+01:00"
            ],
            ['HTTP_Authorization' => 'Bearer ' . $this->token()]
        );
        $this->assertEquals(422, $response->status());
    }

    public function testIncidentDateVAlidation()
    {
        $response = $this->call(
            'POST',
            '/incidents',
            [
                'title' => 'incident title',
                'category' => 1,
                'location' => [
                    'latitude' => '12.9231501',
                    'longitude' => '74.7818517'
                ],
                'people' => [
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "witness"
                    ],
                    [
                        'name' => "Name of person",
                        'type' => "staff"
                    ]
                ],
                "comments" => "This is a string of comments",
                "incidentDate" =>  "2020-13-01T13:26:00+00:00",
                "createDate" =>  "2020-09-01T13:32:59+01:00",
                "modifyDate" =>  "2020-09-01T13:32:59+01:00"
            ],
            ['HTTP_Authorization' => 'Bearer ' . $this->token()]
        );
        $this->assertEquals(422, $response->status());
    }
}
