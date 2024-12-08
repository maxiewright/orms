<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected bool $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('shield:seeder');

        $user = User::find(1);
        $this->actingAs($user);

        $this->artisan('shield:super-admin', ['--user' => 1]);

    }
}
