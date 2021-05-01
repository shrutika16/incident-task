<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetIncidentTest extends TestCase
{
    /**
     * A basic get incident test.
     *
     * @return void
     */
    public function testGetIncident()
    {

        $response = $this->call('GET', '/incidents');

        $this->assertEquals(200, $response->status());
    }
}
