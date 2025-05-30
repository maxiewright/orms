<?php

namespace Modules\Registry\Database\Factories\RegirstryIndex;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;

class IndexSubGroupFactory extends Factory
{
    protected $model = IndexSubGroup::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->jobTitle();
        $groupId = IndexGroup::factory();

        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'reference_number' => $this->faker->unique()->numerify('#/#'),
            'index_group_id' => $groupId,
        ];
    }

    public function forGroup(IndexGroup $group): self
    {
        return $this->state(function (array $attributes) use ($group) {
            return [
                'index_group_id' => $group->id,
            ];
        });
    }
}
