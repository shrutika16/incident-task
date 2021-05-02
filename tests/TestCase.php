<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function token(): string
    {
        $email          = 'shrutika@boppotech.com';
        $password       = 'boppo@123';

        $response       = $this->call('POST', '/login', ['email' => $email, 'password' => $password]);
        $content        = json_decode($response->content());

        if (!isset($content->token)) {
            throw new RuntimeException('Token missing in response');
        }

        return $content->token;
    }
}
