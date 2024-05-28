<?php

namespace Modules\Legal\Database\Factories;

use App\Models\Metadata\Contact\Division;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\JusticeInstitutionType;

class JusticeInstitutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Ancillary\JusticeInstitution::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $division = Division::all()->random()->id;
        $city = Division::find($division)->cities->random()->id;

        return [
            'name' => fake()->company(),
            'type' => fake()->randomElement(JusticeInstitutionType::cases())->value,
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => null,
            'division_id' => $division,
            'city_id' => $city,
        ];
    }

    public function whereType($type): self
    {
        return $this->state(fn () => ['type' => $type]);
    }
}
