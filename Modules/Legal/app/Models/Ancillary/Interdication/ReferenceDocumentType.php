<?php

namespace Modules\Legal\Models\Ancillary\Interdication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\ReferenceDocumentTypeFactory;

class ReferenceDocumentType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): ReferenceDocumentTypeFactory
    {
        //return ReferenceDocumentTypeFactory::new();
    }
}
