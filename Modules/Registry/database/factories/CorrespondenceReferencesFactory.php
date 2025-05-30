<?php

namespace Modules\Registry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Enums\CorrespondenceReferenceType;
use Modules\Registry\Models\Correspondence;
use Modules\Registry\Models\CorrespondenceReferences;

class CorrespondenceReferencesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = CorrespondenceReferences::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'source_correspondence_id' => Correspondence::factory(),
            'related_correspondence_id' => Correspondence::factory(),
            'reference_type' => $this->faker->randomElement(CorrespondenceReferenceType::cases()),
        ];
    }

    /**
     * Indicate that the reference is an annex.
     */
    public function asAnnex(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'reference_type' => CorrespondenceReferenceType::Annex,
            ];
        });
    }

    /**
     * Indicate that the reference is an attachment.
     */
    public function asAttachment(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'reference_type' => CorrespondenceReferenceType::Attachment,
            ];
        });
    }

    /**
     * Indicate that the reference supersedes another correspondence.
     */
    public function asSupersede(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'reference_type' => CorrespondenceReferenceType::Supersede,
            ];
        });
    }

    /**
     * Indicate that the reference is a reference to another correspondence.
     */
    public function asReference(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'reference_type' => CorrespondenceReferenceType::Reference,
            ];
        });
    }

    /**
     * Indicate that the reference is supporting documentation.
     */
    public function asSupporting(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'reference_type' => CorrespondenceReferenceType::Supporting,
            ];
        });
    }
}
