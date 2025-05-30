<?php

namespace Modules\Registry\Filament\Clusters\RegistryIndex\Pages;

use Filament\Forms\Components\Actions\Action as ComponentAction;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Modules\Registry\Filament\Clusters\RegistryIndex;
use Modules\Registry\Models\RegistryIndex\IndexGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubGroup;
use Modules\Registry\Models\RegistryIndex\IndexSubject;

class RegistryLookup extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'registry::filament.clusters.registry-index.pages.registry-lookup';

    protected static ?string $cluster = RegistryIndex::class;

    public ?array $lookupData = [];

    public ?array $reverseLookupData = [];

    // Properties for dynamic search
    public ?string $indexGroup = null;

    public ?string $indexSubGroup = null;

    public ?string $indexSubject = null;

    public ?string $referenceNumber = null;

    public bool $showReferenceNumber = false;

    // Properties for reverse lookup
    public ?string $searchReferenceNumber = null;

    public ?string $foundSubject = null;

    public ?string $foundSubGroup = null;

    public ?string $foundGroup = null;

    public bool $showReverseLookupResults = false;

    // Property to hold multiple search results
    public array $searchResults = [];

    public function mount(): void
    {
        $this->form->fill();
        $this->reverseLookupForm->fill();
    }

    protected function getForms(): array
    {
        return [
            'form',
            'reverseLookupForm',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Registry Lookup')
                    ->description('Select the index group, subgroup, and subject to find the reference number')
                    ->schema([
                        Select::make('indexGroup')
                            ->label('Index Group')
                            ->options(IndexGroup::pluck('name', 'id'))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function () {
                                $this->indexSubGroup = null;
                                $this->indexSubject = null;
                                $this->showReferenceNumber = false;
                            }),

                        Select::make('indexSubGroup')
                            ->label('Index Subgroup')
                            ->options(function (callable $get) {
                                $groupId = $get('indexGroup');
                                if (! $groupId) {
                                    return [];
                                }

                                return IndexSubGroup::where('index_group_id', $groupId)
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->live()
                            ->visible(fn (callable $get) => $get('indexGroup') !== null)
                            ->afterStateUpdated(function (callable $get) {
                                $this->indexSubject = null;

                                $subGroupId = $get('indexSubGroup');
                                if (! $subGroupId) {
                                    $this->showReferenceNumber = false;

                                    return;
                                }

                                $subGroup = IndexSubGroup::find($subGroupId);
                                if ($subGroup) {
                                    $this->referenceNumber = $subGroup->reference_number;
                                    $this->showReferenceNumber = true;
                                }
                            }),

                        Placeholder::make('noSubjectsPlaceholder')
                            ->label('No Subjects Available')
                            ->content('There are no subjects listed for this subgroup.')
                            ->visible(function (callable $get) {
                                $subGroupId = $get('indexSubGroup');
                                if (! $subGroupId) {
                                    return false;
                                }

                                $subjectsCount = IndexSubject::where('index_sub_group_id', $subGroupId)->count();

                                return $subjectsCount === 0;
                            }),

                        Select::make('indexSubject')
                            ->label('Index Subject')
                            ->options(function (callable $get) {
                                $subGroupId = $get('indexSubGroup');
                                if (! $subGroupId) {
                                    return [];
                                }

                                return IndexSubject::where('index_sub_group_id', $subGroupId)
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->live()
                            ->visible(function (callable $get) {
                                $subGroupId = $get('indexSubGroup');
                                if (! $subGroupId) {
                                    return false;
                                }

                                $subjectsCount = IndexSubject::where('index_sub_group_id', $subGroupId)->count();

                                return $subjectsCount > 0;
                            })
                            ->afterStateUpdated(function (callable $get) {
                                $subjectId = $get('indexSubject');
                                if (! $subjectId) {
                                    return;
                                }

                                $subject = IndexSubject::find($subjectId);
                                if ($subject) {
                                    $this->referenceNumber = $subject->reference_number;
                                    $this->showReferenceNumber = true;
                                }
                            }),

                        TextInput::make('referenceNumber')
                            ->label('Reference Number')
                            ->default(fn () => $this->referenceNumber)
                            ->disabled()
                            ->placeholder('Select a group, subgroup, and subject to see the reference number')
                            ->visible(fn () => $this->showReferenceNumber)
                            ->suffixAction(
                                ComponentAction::make('copy')
                                    ->icon('heroicon-m-clipboard')
                                    ->label('Copy Reference Number')
                                    ->action(function ($livewire, $state) {
                                        $referenceNumber = json_encode($state);

                                        $livewire->js("window.navigator.clipboard.writeText($referenceNumber)");

                                        Notification::make()
                                            ->title('Copied!')
                                            ->body("Reference number $state copied to clipboard")
                                            ->success()
                                            ->send();
                                    })
                            ),
                    ]),
            ]);
    }

    public function reverseLookupForm(Form $form): Form
    {
        return $form
            ->statePath('reverseLookupData')
            ->schema([
                Section::make('Reverse Registry Lookup')
                    ->description('Enter a reference number to find the corresponding group, subgroup, and subject')
                    ->schema([
                        TextInput::make('searchReferenceNumber')
                            ->label('Reference Number')
                            ->placeholder('Enter reference number')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state) {
                                $trimmedState = trim((string) $state);
                                if (strlen($trimmedState) >= 2) {
                                    $this->searchReferenceNumber = $trimmedState;
                                    $this->performReverseLookup();
                                } else {
                                    $this->showReverseLookupResults = false;
                                    $this->searchResults = [];
                                }
                            }),

                        ViewField::make('reverseLookupResults')
                            ->label('')
                            ->view('registry::filament.clusters.registry-index.pages.registry-lookup.reverse-lookup-results')
                            ->viewData([
                                'results' => $this->searchResults,
                                'showResults' => $this->showReverseLookupResults,
                            ])
                            ->visible(fn () => $this->showReverseLookupResults),
                    ])
                    ->extraAttributes(['class' => 'mt-8']),

                TextInput::make('dummy')
                    ->label('')
                    ->placeholder('')
                    ->hidden()
                    ->dehydrated(false),
            ])
            ->statePath('reverseLookupData');
    }

    protected function performReverseLookup(): void
    {
        $this->showReverseLookupResults = true;
        $this->searchResults = [];

        $searchTerm = trim((string) $this->searchReferenceNumber);

        // Count slashes to determine if we're looking for a subject or subgroup
        $slashCount = substr_count($searchTerm, '/');

        // If the reference number has two slashes (e.g., 1/2/1), search for subjects
        if ($slashCount >= 2 || strpos($searchTerm, '/') === false) {
            // Find matching subjects
            $subjects = IndexSubject::query()
                ->where('reference_number', 'ILIKE', '%'.$searchTerm.'%')
                ->orWhere('name', 'ILIKE', '%'.$searchTerm.'%')
                ->with(['indexSubGroup.indexGroup'])
                ->limit(10)
                ->get();

            foreach ($subjects as $subject) {
                $this->searchResults[] = [
                    'type' => 'subject',
                    'reference_number' => $subject->reference_number,
                    'subject' => $subject->name,
                    'subgroup' => $subject->indexSubGroup->name,
                    'group' => $subject->indexGroup->name,
                ];
            }
        }
        // If the reference number has one slash (e.g., 1/2), search for subgroups
        elseif ($slashCount == 1) {
            // Find matching subgroups
            $subGroups = IndexSubGroup::query()
                ->where('reference_number', 'ILIKE', '%'.$searchTerm.'%')
                ->orWhere('name', 'ILIKE', '%'.$searchTerm.'%')
                ->with(['indexGroup'])
                ->limit(10)
                ->get();

            foreach ($subGroups as $subGroup) {
                $this->searchResults[] = [
                    'type' => 'subgroup',
                    'reference_number' => $subGroup->reference_number,
                    'subject' => null,
                    'subgroup' => $subGroup->name,
                    'group' => $subGroup->indexGroup->name,
                ];
            }
        }

        // For backward compatibility, set the first result as the found result
        if (count($this->searchResults) > 0) {
            $firstResult = $this->searchResults[0];
            $this->foundSubject = $firstResult['subject'];
            $this->foundSubGroup = $firstResult['subgroup'];
            $this->foundGroup = $firstResult['group'];
        } else {
            $this->foundSubject = null;
            $this->foundSubGroup = null;
            $this->foundGroup = null;
        }
    }
}
