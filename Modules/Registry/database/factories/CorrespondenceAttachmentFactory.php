<?php

namespace Modules\Registry\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Enums\CorrespondenceAttachmentType;
use Modules\Registry\Enums\CorrespondenceClassification;
use Modules\Registry\Models\Correspondence;
use Modules\Registry\Models\CorrespondenceAttachment;

class CorrespondenceAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = CorrespondenceAttachment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $isPhysical = $this->faker->boolean(20); // 20% chance of being physical

        return [
            'correspondence_id' => Correspondence::factory(),
            'name' => $this->faker->words(3, true),
            'classification' => $this->faker->randomElement(CorrespondenceClassification::cases()),
            'type' => $this->faker->randomElement(CorrespondenceAttachmentType::cases()),
            'file_path' => $isPhysical ? null : $this->faker->filePath(),
            'mime_type' => $isPhysical ? null : $this->faker->mimeType(),
            'size' => $isPhysical ? null : $this->faker->numberBetween(1000, 10000000),
            'is_physical' => $isPhysical,
            'physical_location' => $isPhysical ? $this->faker->words(3, true) : null,
            'physical_condition' => $isPhysical ? $this->faker->randomElement(['Excellent', 'Good', 'Fair', 'Poor']) : null,
            'page_count' => $this->faker->numberBetween(1, 100),
            'access_instructions' => $this->faker->optional(0.3)->sentence(),
            'notes' => $this->faker->optional(0.5)->paragraph(),
            'uploaded_by_user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the attachment is a main document.
     */
    public function asMainDocument(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => CorrespondenceAttachmentType::MainDocument,
            ];
        });
    }

    /**
     * Indicate that the attachment is an annex.
     */
    public function asAnnex(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => CorrespondenceAttachmentType::Annex,
            ];
        });
    }

    /**
     * Indicate that the attachment is an enclosure.
     */
    public function asEnclosure(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => CorrespondenceAttachmentType::Enclosure,
            ];
        });
    }

    /**
     * Indicate that the attachment is physical.
     */
    public function physical(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_physical' => true,
                'file_path' => null,
                'mime_type' => null,
                'size' => null,
                'physical_location' => $this->faker->words(3, true),
                'physical_condition' => $this->faker->randomElement(['Excellent', 'Good', 'Fair', 'Poor']),
            ];
        });
    }

    /**
     * Indicate that the attachment is digital.
     */
    public function digital(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_physical' => false,
                'file_path' => $this->faker->filePath(),
                'mime_type' => $this->faker->mimeType(),
                'size' => $this->faker->numberBetween(1000, 10000000),
                'physical_location' => null,
                'physical_condition' => null,
            ];
        });
    }
}
