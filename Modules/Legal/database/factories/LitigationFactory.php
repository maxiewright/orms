<?php

namespace Modules\Legal\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Legal\Enums\LegalAction\LitigationCategoryType;
use Modules\Legal\Models\Ancillary\Litigation\LitigationCategory;
use Modules\Legal\Models\LegalAction\PreActionProtocol;

class LitigationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Legal\Models\Litigation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {

        $filedAt = fake()->dateTimeBetween('-60 days');
        $year = $filedAt->format('Y');

        $caseNumber = "CV$year-".fake()->numerify('00###');

        return [
            'case_number' => $caseNumber,
            'type_id' => LitigationCategory::all()->where('type', LitigationCategoryType::Type)->random()->id,
            'status_id' => LitigationCategory::all()->where('type', LitigationCategoryType::Status)->random()->id,
            'pre_action_protocol_id' => null,
            'reason_id' => LitigationCategory::all()->where('type', LitigationCategoryType::Reason)->random()->id,
            'outcome_id' => null,
            'filed_at' => $filedAt,
            'started_at' => null,
            'ended_at' => null,
            'damages_awarded' => null,
            'settlement_date' => null,
            'settlement_amount' => null,
            'particulars' => fake()->paragraph(),
        ];
    }

    public function hasPreActionProtocol(): self
    {
        return $this->state(fn () => [
            'pre_action_protocol_id' => PreActionProtocol::factory(),
        ]);
    }

    public function started(): self
    {
        $filedAt = fake()->dateTimeBetween('-60 days', '-30 days');

        return $this->state(fn () => [
            'filed_at' => $filedAt,
            'started_at' => fake()->dateTimeBetween($filedAt),
        ]);
    }

    public function ended(): self
    {
        $filedAt = fake()->dateTimeBetween('-6 months', '-3 months');
        $startedAt = fake()->dateTimeBetween($filedAt, '-30 days');

        return $this->state(fn () => [
            'filed_at' => $filedAt,
            'started_at' => $startedAt,
            'outcome_id' => LitigationCategory::all()->where('type', LitigationCategoryType::Outcome)->random()->id,
            'ended_at' => fake()->dateTimeBetween($startedAt),
        ]);
    }
}
