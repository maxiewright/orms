<?php

namespace Modules\Registry\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Enums\CorrespondenceRecipientType;
use Modules\Registry\Models\Correspondence;
use Modules\Registry\Models\CorrespondenceRecipient;

class CorrespondenceRecipientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = CorrespondenceRecipient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(CorrespondenceRecipientType::cases());
        $actionRequired = $type === CorrespondenceRecipientType::Action;
        $actionBy = $actionRequired ? $this->faker->dateTimeBetween('now', '+3 months') : null;

        // Determine if the correspondence has been received
        $received = $this->faker->boolean(70);
        $receivedAt = $received ? $this->faker->dateTimeBetween('-1 month', 'now') : null;

        // Determine if the correspondence has been viewed
        $viewed = $received && $this->faker->boolean(80);
        $viewedAt = $viewed ? $this->faker->dateTimeBetween($receivedAt, 'now') : null;

        // Determine if action has been taken (only if action is required and correspondence has been viewed)
        $actioned = $actionRequired && $viewed && $this->faker->boolean(60);
        $actionedAt = $actioned ? $this->faker->dateTimeBetween($viewedAt, 'now') : null;

        return [
            'correspondence_id' => Correspondence::factory(),
            'recipient_type' => User::class,
            'recipient_id' => User::factory(),
            'recipient_location_type' => null,
            'recipient_location_id' => null,
            'type' => $type,
            'action_by' => $actionBy,
            'action_status' => $actionRequired ? ($actioned ? 'completed' : 'pending') : null,
            'actioned_at' => $actionedAt,
            'received_by' => $received ? User::factory() : null,
            'received_at' => $receivedAt,
            'viewed_at' => $viewedAt,
        ];
    }

    /**
     * Indicate that the recipient requires action.
     */
    public function requiresAction(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => CorrespondenceRecipientType::Action,
                'action_by' => $this->faker->dateTimeBetween('now', '+3 months'),
                'action_status' => 'pending',
            ];
        });
    }

    /**
     * Indicate that the recipient is for information only.
     */
    public function forInformation(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => CorrespondenceRecipientType::Information,
                'action_by' => null,
                'action_status' => null,
                'actioned_at' => null,
            ];
        });
    }

    /**
     * Indicate that the correspondence has been received.
     */
    public function received(): self
    {
        return $this->state(function (array $attributes) {
            $receivedAt = $this->faker->dateTimeBetween('-1 month', 'now');

            return [
                'received_by' => User::factory(),
                'received_at' => $receivedAt,
            ];
        });
    }

    /**
     * Indicate that the correspondence has been viewed.
     */
    public function viewed(): self
    {
        return $this->state(function (array $attributes) {
            $receivedAt = $attributes['received_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');

            return [
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $receivedAt,
                'viewed_at' => $this->faker->dateTimeBetween($receivedAt, 'now'),
            ];
        });
    }

    /**
     * Indicate that the required action has been completed.
     */
    public function actionCompleted(): self
    {
        return $this->state(function (array $attributes) {
            $receivedAt = $attributes['received_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $viewedAt = $attributes['viewed_at'] ?? $this->faker->dateTimeBetween($receivedAt, '-1 day');

            return [
                'type' => CorrespondenceRecipientType::Action,
                'action_by' => $attributes['action_by'] ?? $this->faker->dateTimeBetween('now', '+3 months'),
                'action_status' => 'completed',
                'actioned_at' => $this->faker->dateTimeBetween($viewedAt, 'now'),
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $receivedAt,
                'viewed_at' => $viewedAt,
            ];
        });
    }
}
