<?php

namespace Modules\Registry\Database\Factories\RegirstryIndex;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Registry\Models\RegistryIndex\IndexGroup;

class IndexGroupFactory extends Factory
{
    protected $model = IndexGroup::class;

    public function definition(): array
    {
        $name = fake()->unique()->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
