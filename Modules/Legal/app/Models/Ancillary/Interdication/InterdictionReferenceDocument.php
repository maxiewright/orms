<?php

namespace Modules\Legal\Models\Ancillary\Interdication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Legal\Database\Factories\InterdictionReferenceDocumentFactory;

class InterdictionReferenceDocument extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): InterdictionReferenceDocumentFactory
    {
        //return InterdictionReferenceDocumentFactory::new();
    }
}
