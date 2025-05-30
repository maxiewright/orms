<?php

namespace Modules\Registry\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Registry\Enums\CorrespondenceClassification;
use Modules\Registry\Enums\CorrespondenceDispatchMethod;
use Modules\Registry\Enums\CorrespondencePriority;
use Modules\Registry\Enums\CorrespondenceStatus;
use Modules\Registry\Enums\CorrespondenceType;
use Modules\Registry\Models\Correspondence;

class CorrespondenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Correspondence::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $subject = $this->faker->sentence();
        $referenceNumber = 'REF-' . $this->faker->unique()->numerify('######');

        return [
            'file_path' => $this->faker->optional()->filePath(),
            'reference_number' => $referenceNumber,
            'external_reference' => $this->faker->optional()->bothify('EXT-????-####'),
            'correspondence_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'slug' => Str::slug($referenceNumber),
            'subject' => $subject,
            'body' => $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(CorrespondenceStatus::cases()),
            'type' => $this->faker->randomElement(CorrespondenceType::cases()),
            'classification' => $this->faker->randomElement(CorrespondenceClassification::cases()),
            'priority' => $this->faker->randomElement(CorrespondencePriority::cases()),
            'security_caveats' => $this->faker->optional()->sentence(),
            'response_required' => $this->faker->boolean(),
            'response_due_by' => $this->faker->optional()->dateTimeBetween('now', '+3 months'),
            'response_to' => null, // Will be set in a state method if needed
            'sender_type' => User::class,
            'sender_id' => User::factory(),
            'description' => $this->faker->optional()->paragraph(),
            'action_required' => $this->faker->optional()->sentence(),
            'created_by' => User::factory(),
            'updated_by' => function (array $attributes) {
                return $attributes['created_by'];
            },
        ];
    }

    /**
     * Indicate that the correspondence is a response to another correspondence.
     */
    public function asResponseTo(Correspondence $correspondence): self
    {
        return $this->state(function (array $attributes) use ($correspondence) {
            return [
                'response_to' => $correspondence->id,
            ];
        });
    }

    /**
     * Indicate that the correspondence has been dispatched.
     */
    public function dispatched(User $dispatchedBy = null): self
    {
        return $this->state(function (array $attributes) use ($dispatchedBy) {
            return [
                'status' => CorrespondenceStatus::Dispatched,
                'dispatched_by' => $dispatchedBy ? $dispatchedBy->id : User::factory(),
                'dispatch_method' => $this->faker->randomElement(CorrespondenceDispatchMethod::cases()),
                'dispatched_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            ];
        });
    }
}
