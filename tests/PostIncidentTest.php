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
        $this->post(
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
            ]
        )
            ->seeJson([
                'created' => true,
            ]);
    }

    public function testlocationValidation()
    {
        $this->post(
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
            ]
        )
            ->seeJson([
                'created' => true,
            ]);
    }

    public function testCategoryIdRequire()
    {
        $this->post(
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
            ]
        )
            ->seeJson([
                'created' => true,
            ]);
    }

    public function testCategoryIdInvalid()
    {
        $this->post(
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
            ]
        )
        ->seeJson([
            'created' => true,
        ]);
    }

    public function testIncidentDateVAlidation()
    {
        $this->post(
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
            ]
        )
            ->seeJson([
                'created' => true,
            ]);
    }
}
