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
        dd($this->token());
        $response = $this->call('GET', '/incidents', ['HTTP_Authorization' => 'Bearer '. $this->token()]);

        $this->assertEquals(200, $response->status());
    }
}
