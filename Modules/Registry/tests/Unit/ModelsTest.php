<?php

use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Modules\Registry\Tests\TestCase\RegistryTestCase;

uses(RegistryTestCase::class);

it('can create an index group', function () {
    $group = IndexGroup::factory()->create();

    $this->assertDatabaseHas('index_groups', [
        'id' => $group->id,
        'name' => $group->name,
    ]);
});

it('can create an index subgroup', function () {
    $group = IndexGroup::factory()->create();
    $subgroup = IndexSubGroup::factory()->forGroup($group)->create();

    $this->assertDatabaseHas('index_sub_groups', [
        'id' => $subgroup->id,
        'name' => $subgroup->name,
        'index_group_id' => $group->id,
    ]);
});

it('can create an index subject', function () {
    $group = IndexGroup::factory()->create();
    $subgroup = IndexSubGroup::factory()->forGroup($group)->create();
    $subject = IndexSubject::factory()->forSubGroup($subgroup)->create();

    $this->assertDatabaseHas('index_subjects', [
        'id' => $subject->id,
        'name' => $subject->name,
        'index_sub_group_id' => $subgroup->id,
    ]);
});
