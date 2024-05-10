<?php

namespace Modules\Legal\Models\Ancillary\Infraction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\SummaryOffenceSectionFactory;

class SummaryOffenceSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): SummaryOffenceSectionFactory
    {
        //return SummaryOffenceSectionFactory::new();
    }
}
