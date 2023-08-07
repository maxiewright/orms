<?php

namespace Tests;

use App\Models\Serviceperson;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->artisan('shield:generate');
        $this->artisan('shield:super-admin', ['--user' => '1']);

    }
}
