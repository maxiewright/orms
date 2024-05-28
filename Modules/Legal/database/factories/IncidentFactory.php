<?php

namespace Modules\Legal\Database\Factories;

use App\Models\Metadata\Contact\Division;
use App\Models\Serviceperson;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\Incident\IncidentStatus;
use Modules\Legal\Enums\Incident\IncidentType;

class IncidentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Incident::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $serviceperson = Serviceperson::factory()->enlisted()->create()->number;
        $type = fake()->randomElement(IncidentType::cases())->value;
        $occurredAt = fake()->dateTimeBetween('-30 days', 'now');
        $date = Carbon::make($occurredAt)->format(config('legal.date'));

        $name = "$serviceperson $type $date";

        $division = Division::all()->random()->id;
        $city = Division::find($division)->cities->random()->id;

        return [
            'name' => $name,
            'type' => $type,
            'serviceperson_number' => $serviceperson,
            'occurred_at' => $occurredAt,
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => fake()->streetName(),
            'division_id' => $division,
            'city_id' => $city,
            'status' => fake()->randomElement(IncidentStatus::cases()),
            'particulars' => fake()->sentence(),
        ];
    }

    public function whereType($type): self
    {
        return $this->state(fn () => ['type' => $type]);
    }

    public function whereStatus($status): self
    {
        return $this->state(fn () => ['status' => $status]);
    }
}
