<?php

namespace Modules\Legal\Models\Ancillary\Interdiction;

use App\Traits\SluggableByName;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Legal\Database\Factories\LegalCorrespondenceFactory;
use Modules\Legal\traits\Referenceable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LegalCorrespondence extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Referenceable;
    use SluggableByName;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reference',
        'date',
        'name',
        'subject',
        'legal_correspondence_type_id',
        'particulars',
    ];

    protected static function newFactory(): LegalCorrespondenceFactory
    {
        return ReferenceDocumentFactory::new();
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(LegalCorrespondenceType::class, 'legal_correspondence_type_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 50, 50)
            ->nonQueued();
    }

    public static function getForm($type = null): array
    {
        return [
            Group::make()
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    Select::make('legal_correspondence_type_id')
                        ->relationship('documentType', 'name')
                        ->label('Document Type')
                        ->default($type)
                        ->required()
                        ->createOptionForm(LegalCorrespondenceType::getForm()),
                    TextInput::make('reference')
                        ->label('Reference')
                        ->required(),
                    DatePicker::make('date')
                        ->label('Date')
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set, $state) {
                            $ref = $get('reference');
                            $date = Carbon::make($state)->format('d M y');
                            $name = $ref.' dated '.$date;

                            $set('name', $name);
                        })
                        ->before('now'),
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    TextInput::make('subject')
                        ->label('Subject')
                        ->columnSpan(2)
                        ->required(),
                ]),
            SpatieMediaLibraryFileUpload::make('correspondence')
                ->collection('legal_correspondence')
                ->acceptedFileTypes(['application/pdf'])
                ->columnSpanFull()
                ->previewable()
                ->multiple(),
            RichEditor::make('particulars')
                ->label('Particulars')
                ->columnSpanFull(),
        ];
    }
}
