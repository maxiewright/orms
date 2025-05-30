<?php

namespace Modules\Registry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CorrespondenceTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Registry\Models\CorrespondenceTag::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'correspondence_id' => \Modules\Registry\Models\Correspondence::factory(),
            'tag_id' => \Modules\Registry\Models\Tag::factory(),
        ];
    }
}
