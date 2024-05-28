<?php

namespace Modules\Legal\Models\Ancillary\Litigation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Legal\Database\Factories\PreActionProtocolTypeFactory;

class PreActionProtocolType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): PreActionProtocolTypeFactory
    {
        //return PreActionProtocolTypeFactory::new();
    }
}
