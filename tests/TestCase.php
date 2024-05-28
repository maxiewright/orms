<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    //    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->artisan('db:seed', ['--class' => 'AdminServicepersonSeeder']);
        $this->artisan('module:seed', ['module' => 'Legal', '--class' => 'OffenceSeeder']);
        $this->artisan('shield:generate');
        $this->artisan('shield:super-admin', ['--user' => 1]);

        $this->actingAs(User::first());

    }
}
