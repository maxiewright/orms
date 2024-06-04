<?php

namespace Modules\Legal\Database\Factories;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\LegalAction\PreActionProtocolStatus;
use Modules\Legal\Models\Ancillary\Litigation\PreActionProtocolType;
use Modules\Legal\Models\LegalAction\PreActionProtocol;

class PreActionProtocolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = PreActionProtocol::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $documentDate = fake()->dateTimeBetween('-60 days', '-7days');
        $dateReceived = fake()->dateTimeBetween($documentDate);
        $respondBy = fake()->dateTimeBetween($dateReceived, '+30 days');

        return [
            'subject' => fake()->sentence(),
            'pre_action_protocol_type_id' => PreActionProtocolType::factory(),
            'parent_id' => null,
            'dated_at' => $documentDate,
            'received_by' => Serviceperson::all()->random()->number,
            'received_at' => $dateReceived,
            'respond_by' => $respondBy,
            'status' => PreActionProtocolStatus::Pending,
            'responded_at' => null,
        ];
    }

    public function responded(): self
    {
        return $this->state(fn ($preActionProtocol) => [
            'responded_at' => fake()->dateTimeBetween('-7 days', $preActionProtocol->respond_by),
        ]);
    }

    public function whereStatus(PreActionProtocolStatus $status): self
    {
        return $this->state(fn () => [
            'status' => $status,
        ]);
    }
}
