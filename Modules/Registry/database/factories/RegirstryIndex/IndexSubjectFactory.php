<?php

namespace Modules\Registry\Database\Factories\RegirstryIndex;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubject;

class IndexSubjectFactory extends Factory
{
    protected $model = IndexSubject::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->text(30);
        $subGroupId = IndexSubGroup::factory();

        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'reference_number' => $this->faker->unique()->numerify('#/#/#'),
            'index_sub_group_id' => $subGroupId,
        ];
    }

    public function forSubGroup(IndexSubGroup $subGroup): self
    {
        return $this->state(function (array $attributes) use ($subGroup) {
            return [
                'index_sub_group_id' => $subGroup->id,
                'reference_number' => $subGroup->reference_number.'/'.$this->faker->unique()->numberBetween(1, 100),
            ];
        });
    }
}
