<?php

namespace Modules\Registry\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Enums\CorrespondenceDispatchManifestStatus;
use Modules\Registry\Models\CorrespondenceDispatchManifest;

class CorrespondenceDispatchManifestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = CorrespondenceDispatchManifest::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $preparedAt = $this->faker->dateTimeBetween('-1 month', 'now');
        $status = $this->faker->randomElement(CorrespondenceDispatchManifestStatus::cases());

        // Determine if we need courier and received information based on status
        $needsCourier = in_array($status, [
            CorrespondenceDispatchManifestStatus::InTransit,
            CorrespondenceDispatchManifestStatus::DeliveredToOffice,
            CorrespondenceDispatchManifestStatus::OfficeAcknowledged,
            CorrespondenceDispatchManifestStatus::CompletedArchived,
        ]);

        $needsReceived = in_array($status, [
            CorrespondenceDispatchManifestStatus::DeliveredToOffice,
            CorrespondenceDispatchManifestStatus::OfficeAcknowledged,
            CorrespondenceDispatchManifestStatus::CompletedArchived,
        ]);

        $courierId = $needsCourier ? User::factory() : null;
        $courierCollectedAt = $needsCourier ? $this->faker->dateTimeBetween($preparedAt, 'now') : null;
        $courierDeliveredAt = $needsReceived ? $this->faker->dateTimeBetween($courierCollectedAt ?? $preparedAt, 'now') : null;

        return [
            'reference_number' => 'MAN-' . $this->faker->unique()->numerify('######'),
            'destination_type' => User::class,
            'destination_id' => User::factory(),
            'prepared_by' => User::factory(),
            'prepared_at' => $preparedAt,
            'status' => $status,
            'courier_id' => $courierId,
            'courier_collected_at' => $courierCollectedAt,
            'courier_delivered_at' => $courierDeliveredAt,
            'received_by' => $needsReceived ? User::factory() : null,
            'received_at' => $needsReceived ? $this->faker->dateTimeBetween($courierDeliveredAt ?? $preparedAt, 'now') : null,
            'scanned_form_path' => $this->faker->optional(0.3)->filePath(),
            'notes' => $this->faker->optional(0.3)->paragraph(),
        ];
    }

    /**
     * Indicate that the manifest is in preparation.
     */
    public function preparing(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => CorrespondenceDispatchManifestStatus::Preparing,
                'courier_id' => null,
                'courier_collected_at' => null,
                'courier_delivered_at' => null,
                'received_by' => null,
                'received_at' => null,
            ];
        });
    }

    /**
     * Indicate that the manifest is awaiting collection.
     */
    public function awaitingCollection(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => CorrespondenceDispatchManifestStatus::AwaitingCollection,
                'courier_id' => null,
                'courier_collected_at' => null,
                'courier_delivered_at' => null,
                'received_by' => null,
                'received_at' => null,
            ];
        });
    }

    /**
     * Indicate that the manifest is in transit.
     */
    public function inTransit(): self
    {
        return $this->state(function (array $attributes) {
            $preparedAt = $attributes['prepared_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $courierCollectedAt = $this->faker->dateTimeBetween($preparedAt, 'now');

            return [
                'status' => CorrespondenceDispatchManifestStatus::InTransit,
                'courier_id' => User::factory(),
                'courier_collected_at' => $courierCollectedAt,
                'courier_delivered_at' => null,
                'received_by' => null,
                'received_at' => null,
            ];
        });
    }

    /**
     * Indicate that the manifest has been delivered.
     */
    public function delivered(): self
    {
        return $this->state(function (array $attributes) {
            $preparedAt = $attributes['prepared_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $courierCollectedAt = $attributes['courier_collected_at'] ?? $this->faker->dateTimeBetween($preparedAt, '-1 day');
            $courierDeliveredAt = $this->faker->dateTimeBetween($courierCollectedAt, 'now');

            return [
                'status' => CorrespondenceDispatchManifestStatus::DeliveredToOffice,
                'courier_id' => $attributes['courier_id'] ?? User::factory(),
                'courier_collected_at' => $courierCollectedAt,
                'courier_delivered_at' => $courierDeliveredAt,
                'received_by' => User::factory(),
                'received_at' => $this->faker->dateTimeBetween($courierDeliveredAt, 'now'),
            ];
        });
    }

    /**
     * Indicate that the manifest has been acknowledged.
     */
    public function acknowledged(): self
    {
        return $this->state(function (array $attributes) {
            $preparedAt = $attributes['prepared_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $courierCollectedAt = $attributes['courier_collected_at'] ?? $this->faker->dateTimeBetween($preparedAt, '-1 day');
            $courierDeliveredAt = $attributes['courier_delivered_at'] ?? $this->faker->dateTimeBetween($courierCollectedAt, '-1 day');

            return [
                'status' => CorrespondenceDispatchManifestStatus::OfficeAcknowledged,
                'courier_id' => $attributes['courier_id'] ?? User::factory(),
                'courier_collected_at' => $courierCollectedAt,
                'courier_delivered_at' => $courierDeliveredAt,
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $attributes['received_at'] ?? $this->faker->dateTimeBetween($courierDeliveredAt, 'now'),
            ];
        });
    }

    /**
     * Indicate that the manifest has been completed and archived.
     */
    public function completed(): self
    {
        return $this->state(function (array $attributes) {
            $preparedAt = $attributes['prepared_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $courierCollectedAt = $attributes['courier_collected_at'] ?? $this->faker->dateTimeBetween($preparedAt, '-1 day');
            $courierDeliveredAt = $attributes['courier_delivered_at'] ?? $this->faker->dateTimeBetween($courierCollectedAt, '-1 day');

            return [
                'status' => CorrespondenceDispatchManifestStatus::CompletedArchived,
                'courier_id' => $attributes['courier_id'] ?? User::factory(),
                'courier_collected_at' => $courierCollectedAt,
                'courier_delivered_at' => $courierDeliveredAt,
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $attributes['received_at'] ?? $this->faker->dateTimeBetween($courierDeliveredAt, 'now'),
            ];
        });
    }
}
