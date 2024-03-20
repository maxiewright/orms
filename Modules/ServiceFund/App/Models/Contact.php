<?php

namespace Modules\ServiceFund\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ServiceFund\Database\factories\ContactFactory;
use Modules\ServiceFund\Traits\HasAddress;
use Modules\ServiceFund\Traits\HasTransactions;

class Contact extends Model
{
    use HasAddress;
    use HasFactory;
    use HasTransactions;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'website',
        'address_line_1',
        'address_line_2',
        'city_id',
        'added_by',
        'added_on',
        'is_active',
    ];

    protected $casts = [
        'added_on' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected $with = [
        'city',
    ];

    protected $appends = [
        'address',
    ];

    protected static function newFactory(): ContactFactory
    {
        return ContactFactory::new();
    }

    public static function getCityModelName(): string
    {

        return (new \ReflectionClass(config('servicefund.address.city')))
            ->getShortName();
    }
}
