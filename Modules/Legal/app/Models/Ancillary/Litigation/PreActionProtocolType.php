<?php

namespace Modules\Legal\Models\Ancillary\Litigation;

use App\Traits\SluggableByName;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\Ancillary\PreActionProtocolTypeFactory;

class PreActionProtocolType extends Model
{
    use HasFactory;
    use SluggableByName;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'slug', 'description'];

    protected static function newFactory(): PreActionProtocolTypeFactory
    {
        return PreActionProtocolTypeFactory::new();
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->columnSpanFull()
                ->required(),
            RichEditor::make('description')
                ->columnSpanFull(),
        ];
    }
}
