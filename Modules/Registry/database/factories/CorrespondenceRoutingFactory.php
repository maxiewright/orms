<?php

namespace Modules\Registry\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Enums\CorrespondenceRoutingActionOutcome;
use Modules\Registry\Enums\CorrespondenceRoutingStatus;
use Modules\Registry\Models\Correspondence;
use Modules\Registry\Models\CorrespondenceRouting;

class CorrespondenceRoutingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = CorrespondenceRouting::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(CorrespondenceRoutingStatus::cases());
        $routingAt = $this->faker->dateTimeBetween('-1 month', 'now');

        // Determine if the routing has been received
        $received = in_array($status, [
            CorrespondenceRoutingStatus::Viewed,
            CorrespondenceRoutingStatus::BeingActioned,
            CorrespondenceRoutingStatus::Actioned,
            CorrespondenceRoutingStatus::Forwarded,
            CorrespondenceRoutingStatus::Returned,
        ]);
        $receivedAt = $received ? $this->faker->dateTimeBetween($routingAt, 'now') : null;

        // Determine if action has been taken
        $actioned = in_array($status, [
            CorrespondenceRoutingStatus::Actioned,
            CorrespondenceRoutingStatus::Forwarded,
            CorrespondenceRoutingStatus::Returned,
        ]);
        $actionedAt = $actioned ? $this->faker->dateTimeBetween($receivedAt ?? $routingAt, 'now') : null;

        return [
            'correspondence_id' => Correspondence::factory(),
            'parent_id' => null, // Will be set in a state method if needed
            'routed_by_type' => User::class,
            'routed_by_id' => User::factory(),
            'routed_to_type' => User::class,
            'routed_to_id' => User::factory(),
            'routing_at' => $routingAt,
            'purpose' => $this->faker->randomElement(['For Information', 'For Action', 'For Comment', 'For Approval', 'For Signature']),
            'instructions_or_initial_remarks' => $this->faker->optional(0.7)->paragraph(),
            'status' => $status,
            'received_by' => $received ? User::factory() : null,
            'received_at' => $receivedAt,
            'action_taken_remarks' => $actioned ? $this->faker->paragraph() : null,
            'action_outcome' => $actioned ? $this->faker->randomElement(CorrespondenceRoutingActionOutcome::cases()) : null,
            'actioned_at' => $actionedAt,
            'bring_up_at' => $this->faker->optional(0.3)->dateTimeBetween('now', '+1 month'),
        ];
    }

    /**
     * Indicate that the routing is pending attention.
     */
    public function pendingAttention(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => CorrespondenceRoutingStatus::PendingAttention,
                'received_by' => null,
                'received_at' => null,
                'action_taken_remarks' => null,
                'action_outcome' => null,
                'actioned_at' => null,
            ];
        });
    }

    /**
     * Indicate that the routing has been viewed.
     */
    public function viewed(): self
    {
        return $this->state(function (array $attributes) {
            $routingAt = $attributes['routing_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $receivedAt = $this->faker->dateTimeBetween($routingAt, 'now');

            return [
                'status' => CorrespondenceRoutingStatus::Viewed,
                'received_by' => User::factory(),
                'received_at' => $receivedAt,
                'action_taken_remarks' => null,
                'action_outcome' => null,
                'actioned_at' => null,
            ];
        });
    }

    /**
     * Indicate that the routing is being actioned.
     */
    public function beingActioned(): self
    {
        return $this->state(function (array $attributes) {
            $routingAt = $attributes['routing_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $receivedAt = $attributes['received_at'] ?? $this->faker->dateTimeBetween($routingAt, '-1 day');

            return [
                'status' => CorrespondenceRoutingStatus::BeingActioned,
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $receivedAt,
                'action_taken_remarks' => null,
                'action_outcome' => null,
                'actioned_at' => null,
            ];
        });
    }

    /**
     * Indicate that the routing has been actioned.
     */
    public function actioned(): self
    {
        return $this->state(function (array $attributes) {
            $routingAt = $attributes['routing_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $receivedAt = $attributes['received_at'] ?? $this->faker->dateTimeBetween($routingAt, '-1 day');
            $actionedAt = $this->faker->dateTimeBetween($receivedAt, 'now');

            return [
                'status' => CorrespondenceRoutingStatus::Actioned,
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $receivedAt,
                'action_taken_remarks' => $this->faker->paragraph(),
                'action_outcome' => CorrespondenceRoutingActionOutcome::Actioned,
                'actioned_at' => $actionedAt,
            ];
        });
    }

    /**
     * Indicate that the routing has been forwarded.
     */
    public function forwarded(): self
    {
        return $this->state(function (array $attributes) {
            $routingAt = $attributes['routing_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $receivedAt = $attributes['received_at'] ?? $this->faker->dateTimeBetween($routingAt, '-1 day');
            $actionedAt = $this->faker->dateTimeBetween($receivedAt, 'now');

            return [
                'status' => CorrespondenceRoutingStatus::Forwarded,
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $receivedAt,
                'action_taken_remarks' => $this->faker->paragraph(),
                'action_outcome' => $this->faker->randomElement([
                    CorrespondenceRoutingActionOutcome::NotedAndFiled,
                    CorrespondenceRoutingActionOutcome::FiledWithReminder,
                    CorrespondenceRoutingActionOutcome::CommentsProvided,
                ]),
                'actioned_at' => $actionedAt,
            ];
        });
    }

    /**
     * Indicate that the routing has been returned.
     */
    public function returned(): self
    {
        return $this->state(function (array $attributes) {
            $routingAt = $attributes['routing_at'] ?? $this->faker->dateTimeBetween('-1 month', '-1 day');
            $receivedAt = $attributes['received_at'] ?? $this->faker->dateTimeBetween($routingAt, '-1 day');
            $actionedAt = $this->faker->dateTimeBetween($receivedAt, 'now');

            return [
                'status' => CorrespondenceRoutingStatus::Returned,
                'received_by' => $attributes['received_by'] ?? User::factory(),
                'received_at' => $receivedAt,
                'action_taken_remarks' => $this->faker->paragraph(),
                'action_outcome' => $this->faker->randomElement([
                    CorrespondenceRoutingActionOutcome::NotedAndFiled,
                    CorrespondenceRoutingActionOutcome::FiledWithReminder,
                    CorrespondenceRoutingActionOutcome::CommentsProvided,
                ]),
                'actioned_at' => $actionedAt,
            ];
        });
    }

    /**
     * Indicate that the routing is a child of another routing.
     */
    public function asChildOf(CorrespondenceRouting $parent): self
    {
        return $this->state(function (array $attributes) use ($parent) {
            return [
                'parent_id' => $parent->id,
                'correspondence_id' => $parent->correspondence_id,
            ];
        });
    }
}
