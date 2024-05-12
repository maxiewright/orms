<?php

namespace Modules\Legal\Models\Ancillary\Interdiction;

use App\Traits\SluggableByName;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LegalCorrespondenceType extends Model
{
    use SluggableByName;

    protected $fillable = [
        'name',
        'description',
    ];

    public function referenceDocument(): HasMany
    {
        return $this->hasMany(LegalCorrespondence::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->label('Name')
                ->required(),
            RichEditor::make('description')
                ->label('Description'),
        ];
    }
}
