<?php

namespace Modules\Registry\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Enums\CorrespondenceDispatchMethod;
use Modules\Registry\Models\CorrespondenceDispatch;
use Modules\Registry\Models\CorrespondenceDispatchManifest;
use Modules\Registry\Models\CorrespondenceRecipient;

class CorrespondenceDispatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = CorrespondenceDispatch::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $method = $this->faker->randomElement(CorrespondenceDispatchMethod::cases());

        // Determine status based on method
        $status = match($method) {
            CorrespondenceDispatchMethod::Email => $this->faker->randomElement(['EMAIL_QUEUED', 'EMAIL_SENT', 'EMAIL_FAILED', 'EMAIL_DELIVERED', 'EMAIL_OPENED']),
            CorrespondenceDispatchMethod::DispatchRider,
            CorrespondenceDispatchMethod::Courier,
            CorrespondenceDispatchMethod::Post => $this->faker->randomElement(['ON_MANIFEST_PENDING_DELIVERY', 'DELIVERED_TO_ADDRESSEE', 'ACKNOWLEDGED_BY_ADDRESSEE']),
            default => $this->faker->randomElement(['NOTIFICATION_SENT', 'ACKNOWLEDGED_IN_SYSTEM']),
        };

        $actionedAt = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'correspondence_recipient_id' => CorrespondenceRecipient::factory(),
            'method' => $method,
            'correspondence_dispatch_manifest_id' => in_array($method, [
                CorrespondenceDispatchMethod::DispatchRider,
                CorrespondenceDispatchMethod::Courier,
                CorrespondenceDispatchMethod::Post
            ]) ? CorrespondenceDispatchManifest::factory() : null,
            'actioned_by' => User::factory(),
            'actioned_at' => $actionedAt,
            'status' => $status,
            'recipient_received_at' => in_array($status, ['DELIVERED_TO_ADDRESSEE', 'ACKNOWLEDGED_BY_ADDRESSEE', 'EMAIL_DELIVERED', 'EMAIL_OPENED', 'ACKNOWLEDGED_IN_SYSTEM'])
                ? $this->faker->dateTimeBetween($actionedAt, 'now')
                : null,
            'receipt_acknowledged_by' => in_array($status, ['ACKNOWLEDGED_BY_ADDRESSEE', 'ACKNOWLEDGED_IN_SYSTEM'])
                ? User::factory()
                : null,
            'notes' => $this->faker->optional(0.3)->paragraph(),
        ];
    }

    /**
     * Indicate that the dispatch is via email.
     */
    public function viaEmail(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'method' => CorrespondenceDispatchMethod::Email,
                'status' => $this->faker->randomElement(['EMAIL_QUEUED', 'EMAIL_SENT', 'EMAIL_FAILED', 'EMAIL_DELIVERED', 'EMAIL_OPENED']),
                'correspondence_dispatch_manifest_id' => null,
            ];
        });
    }

    /**
     * Indicate that the dispatch is via dispatch rider.
     */
    public function viaDispatchRider(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'method' => CorrespondenceDispatchMethod::DispatchRider,
                'status' => $this->faker->randomElement(['ON_MANIFEST_PENDING_DELIVERY', 'DELIVERED_TO_ADDRESSEE', 'ACKNOWLEDGED_BY_ADDRESSEE']),
                'correspondence_dispatch_manifest_id' => CorrespondenceDispatchManifest::factory(),
            ];
        });
    }

    /**
     * Indicate that the dispatch has been acknowledged.
     */
    public function acknowledged(): self
    {
        return $this->state(function (array $attributes) {
            $actionedAt = $attributes['actioned_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $receivedAt = $this->faker->dateTimeBetween($actionedAt, 'now');

            return [
                'status' => match($attributes['method'] ?? null) {
                    CorrespondenceDispatchMethod::Email => 'EMAIL_OPENED',
                    CorrespondenceDispatchMethod::DispatchRider,
                    CorrespondenceDispatchMethod::Courier,
                    CorrespondenceDispatchMethod::Post => 'ACKNOWLEDGED_BY_ADDRESSEE',
                    default => 'ACKNOWLEDGED_IN_SYSTEM',
                },
                'recipient_received_at' => $receivedAt,
                'receipt_acknowledged_by' => User::factory(),
            ];
        });
    }
}
