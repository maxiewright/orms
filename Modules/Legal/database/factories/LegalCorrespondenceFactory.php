<?php

namespace Modules\Legal\Database\Factories;

use App\Models\Unit\Battalion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondenceType;

class LegalCorrespondenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = LegalCorrespondence::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $unit = Battalion::all()->random()->short_name;
        $index = fake()->bothify('#.#.#');
        $reference = $unit.' '.$index;
        $date = fake()->dateTimeBetween('-30 days');
        $subject = fake()->sentence();
        $name = $reference.' dated '.$date->format(config('legal.date')).' - '.$subject;

        return [
            'reference' => $reference,
            'date' => $date,
            'subject' => $subject,
            'name' => $name,
            'legal_correspondence_type_id' => LegalCorrespondenceType::all()->random()->id,
            'particulars' => fake()->paragraph(),
        ];
    }
}
