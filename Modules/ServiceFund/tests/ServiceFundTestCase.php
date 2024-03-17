<?php

namespace Modules\ServiceFund\Tests;

use Modules\ServiceFund\Database\Seeders\TransactionCategorySeeder;
use Tests\TestCase as BaseTestCase;

class ServiceFundTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        beforeEach(function () {
            logInAsUserWithRole();

            filament()->setCurrentPanel(
                filament()->getPanel('service-fund')
            );

            $this->seed(TransactionCategorySeeder::class);

        });
    }
}
