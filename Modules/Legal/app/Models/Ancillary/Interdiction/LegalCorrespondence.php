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

    protected $casts = [
        'date' => 'date',
    ];

    protected static function booted(): void
    {
        static::saving(function (LegalCorrespondence $correspondence) {
            $reference = $correspondence->reference;
            $date = $correspondence->date->format(config('legal.date'));
            $subject = $correspondence->subject;

            $correspondence->name = $reference.' dated '.$date.' - '.$subject;
        });
    }

    protected static function newFactory(): LegalCorrespondenceFactory
    {
        return LegalCorrespondenceFactory::new();
    }

    public function type(): BelongsTo
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
                        ->relationship(name: 'type', titleAttribute: 'name')
                        ->label('Document Type')
                        ->default($type)
                        ->required()
                        ->createOptionForm(LegalCorrespondenceType::getForm()),
                    TextInput::make('reference')
                        ->label('Reference Number / Index')
                        ->required(),
                    DatePicker::make('date')
                        ->label('Document Dated')
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set, $state) {
                            $ref = $get('reference');
                            $date = Carbon::make($state)->format('d M y');
                            $name = $ref.' dated '.$date;

                            $set('name', $name);
                        })
                        ->before('now'),
                    TextInput::make('subject')
                        ->label('Subject / Caption')
                        ->columnSpanFull()
                        ->required(),
                ]),
            SpatieMediaLibraryFileUpload::make('correspondence')
                ->helperText('Upload the file related to the reference document that you are adding')
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
