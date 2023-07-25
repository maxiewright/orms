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
        $this->artisan('shield:generate', ['all']);
        $this->artisan('shield:super-admin', ['--user' => '1']);

        $serviceperson = Serviceperson::factory()
            ->officer()
            ->has(User::factory())
            ->create();

        $serviceperson->user->assignRole('super_admin');

        $this->actingAs($serviceperson->user);
    }
}
