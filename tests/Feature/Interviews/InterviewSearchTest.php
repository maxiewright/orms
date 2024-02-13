<?php

use App\Filament\Resources\InterviewResource\Pages\ListInterviews;
use App\Models\Interview;
use App\Models\Metadata\InterviewReason;
use App\Models\Metadata\InterviewStatus;
use App\Models\Metadata\Rank;
use App\Models\Serviceperson;

use function Pest\Livewire\livewire;

beforeEach(function () {
    logInAsUserWithRole();
});

it('can searched for by number, first_name, middle_name and last_name', function () {
    // Arrange

    // Act and Assert

})->todo();

it('can be filtered by serviceperson rank', function () {
    // Arrange
    $interviews = Interview::factory()->count(10)->pending()
        ->has(Serviceperson::factory()->enlisted())
        ->create();

    $servicepeople = $interviews->first()->servicepeople;

    $rank = Rank::all()->random()->id;

    // Act and Assert
    livewire(ListInterviews::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($interviews)
        ->filterTable('rank')
        ->assertCanSeeTableRecords($servicepeople->where('rank_id', $rank))
        ->assertCanNotSeeTableRecords($servicepeople->where('rank_id', '!=', $rank));
});

it('can be filtered by interview', function (string $name, string $field, int $filter) {
    // Arrange
    $interviews = Interview::factory()->count(10)
        ->pending()->seen()
        ->has(Serviceperson::factory()->enlisted())
        ->create();

    // Act and Assert
    livewire(ListInterviews::class)
        ->removeTableFilters()
        ->filterTable($name)
        ->assertCanSeeTableRecords($interviews->where($field, $filter))
        ->assertCanNotSeeTableRecords($interviews->where($field, '!=', $filter));
    ;

})->with([
    ['status', 'interview_status_id', fn () => InterviewStatus::all()->random()->id],
    ['reason', 'interview_reason_id', fn () => InterviewReason::all()->random()->id],
])->todo();
