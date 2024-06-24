<?php

namespace Modules\Legal\Database\Factories\LegalAction;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Models\LegalAction\PreActionProtocol;

class PreActionProtocolExtensionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\LegalAction\PreActionProtocolExtension::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $extendedOn = fake()->dateTime('7 days');
        $extendedTo = fake()->dateTime($extendedOn);

        return [
            'pre_action_protocol_id' => PreActionProtocol::factory(),
            'extended_on' => $extendedOn,
            'extended_to' => $extendedTo,
            'particulars' => fake()->paragraph(),
        ];
    }
}
