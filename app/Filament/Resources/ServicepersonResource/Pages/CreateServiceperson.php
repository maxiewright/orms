<?php

namespace App\Filament\Resources\ServicepersonResource\Pages;

use App\Enums\Serviceperson\EmailTypeEnum;
use App\Enums\Serviceperson\EmergencyContactTypeEnum;
use App\Enums\Serviceperson\PhoneTypeEnum;
use App\Filament\Resources\ServicepersonResource;
use App\Filament\Traits\RedirectToIndex;
use App\Models\Department;
use App\Models\Metadata\Contact\City;
use App\Models\Metadata\Contact\Division;
use App\Models\Metadata\PersonalInformation\Relationship;
use App\Models\Unit\Company;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Collection;


class CreateServiceperson extends CreateRecord
{
    use RedirectToIndex, CreateRecord\Concerns\HasWizard;

    protected static string $resource = ServicepersonResource::class;

    public function hasSkippableSteps(): bool
    {
        return true;
    }

    protected function getSteps(): array
    {

        return [
            Step::make('Personal Data')
                ->schema([
                    Grid::make(4)->schema([
                        FileUpload::make('attachment')
                            ->imagePreviewHeight('1600')
                            ->loadingIndicatorPosition('left')
                            ->panelAspectRatio('4:3')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left'),
                        Grid::make(4)->schema([
                            TextInput::make('number')
                                ->label('Service Number')
                                ->unique()
                                ->numeric()
                                ->required(),
                            Select::make('rank_id')
                                ->label('Rank')
                                ->relationship('rank', 'name')
                                ->required(),
                            TextInput::make('first_name')->required(),
                            TextInput::make('middle_name'),
                            TextInput::make('last_name')->required(),
                            TextInput::make('other_names'),
                            Select::make('gender_id')
                                ->relationship('gender', 'name')
                                ->required(),
                            DatePicker::make('date_of_birth')
                                ->required()
                                ->displayFormat('d M Y'),
                            Select::make('marital_status_id')
                                ->relationship('maritalStatus', 'name')
                                ->required(),
                            Select::make('religion_id')
                                ->relationship('religion', 'name')
                                ->required(),
                            Select::make('ethnicity_id')
                                ->relationship('ethnicity', 'name')
                                ->required(),
                        ])->columnSpan(3)
                    ]),
                ])->columns(1),
            Step::make('Contact Information')
                ->schema([
                    TextInput::make('address_line_1')->required(),
                    TextInput::make('address_line_2'),
                    Grid::make(2)->schema([
                        Select::make('division')
                            ->options(Division::query()->pluck('name', 'id'))
                            ->live(),
                        Select::make('city_id')
                            ->label('City')
                            ->placeholder(fn(Get $get): string => $get('division')
                                ? 'Select City'
                                : 'Select a division first'
                            )
                            ->searchable(fn(Get $get) => $get('division'))
                            ->options(fn(Get $get): Collection => City::query()
                                ->where('division_id', $get('division'))
                                ->pluck('name', 'id'))
                            ->required(),
                    ]),

                    Grid::make()->schema([
                        /** Phone Number */
                        Repeater::make('phone_number')
                            ->schema([
                                Grid::make()->schema([
                                    Select::make('type')->required()
                                        ->options(PhoneTypeEnum::class)
                                        ->default(PhoneTypeEnum::Mobile)
                                        ->selectablePlaceholder(false),
                                    TextInput::make('phone_number')->required()
                                ]),
                            ])->relationship('phoneNumbers'),
                        /** Email */
                        Repeater::make('phone_number')
                            ->schema([
                                Grid::make()->schema([
                                    Select::make('type')->required()
                                        ->options(EmailTypeEnum::class)
                                        ->default(EmailTypeEnum::Personal)
                                        ->selectablePlaceholder(false),
                                    TextInput::make('email')->email()->required()
                                ]),
                            ])->relationship('emails')
                    ])

                ]),
            Step::make('Service Data')
                ->schema([
                    Fieldset::make('Enlistment Data')->schema([
                        Select::make('enlistment_type_id')
                            ->relationship('enlistmentType', 'name')
                            ->required(),
                        DatePicker::make('enlistment_date')
                            ->required()
                            ->displayFormat('d M Y'),
                        DatePicker::make('assumption_date')
                            ->required()
                            ->displayFormat('d M Y'),
                    ])->columns(3),
                    Fieldset::make('Employment Data')->schema([
                        Select::make('employment_status_id')
                            ->relationship('employmentStatus', 'name')
                            ->selectablePlaceholder(false)
                            ->required()
                            ->default(1),
                        Select::make('battalion_id')
                            ->relationship('battalion', 'name')
                            ->required()
                            ->live(),
                        Select::make('company_id')
                            ->placeholder(fn(Get $get): string => $get('battalion_id')
                                ? 'Select Company'
                                : 'Select Battalion First'
                            )
                            ->options(fn(Get $get): Collection => Company::query()
                                ->where('battalion_id', $get('battalion_id'))
                                ->pluck('short_name', 'id'))
                            ->live(),
                        Select::make('department_id')
                            ->placeholder(fn(Get $get): string => $get('company_id')
                                ? 'Select Department'
                                : 'Select Company First'
                            )
                            ->options(function (Get $get): Collection {
                                return ($get('company_id'))
                                    ? Company::query()
                                        ->find($get('company_id'))
                                        ->departments()
                                        ->pluck('name', 'id')
                                    : collect();
                            }),
                    ])->columns(4),
                ]),

            Step::make('Emergency Contact')
                ->schema([
                    Repeater::make('emergency_contacts')
                        ->relationship('emergencyContacts')
                        ->schema([
                            Grid::make(4)->schema([
                                Select::make('type')
                                    ->options(EmergencyContactTypeEnum::class)
                                    ->default(EmergencyContactTypeEnum::Primary)
                                    ->selectablePlaceholder(false)
                                    ->required(),
                                TextInput::make('first_name')->required(),
                                TextInput::make('last_name')->required(),
                                Select::make('relationship_id')
                                    ->label('Relationship')
                                    ->relationship('relationship', 'name')
                            ]),
                            Grid::make()->schema([
                                /** Phone Number */
                                Repeater::make('phone_number')
                                    ->relationship('phoneNumbers')
                                    ->schema([
                                        Grid::make()->schema([
                                            Select::make('type')->required()
                                                ->options(PhoneTypeEnum::class),
                                            TextInput::make('phone_number')->required()
                                        ]),
                                    ]),
                                /** Email */
                                Repeater::make('email')
                                    ->relationship('emails')
                                    ->schema([
                                        Grid::make()->schema([
                                            Select::make('type')
                                                ->options(EmailTypeEnum::class)
                                                ->required(),
                                            TextInput::make('email')->email()->required()
                                        ]),
                                    ])
                            ]),
                        ])
                ])->columns(1),
        ];
    }
}
