<?php

namespace Modules\Legal\Models\LegalAction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Legal\Database\Factories\LegalAction\PreActionProtocolExtensionFactory;

class PreActionProtocolExtension extends Model
{
    use HasFactory;

    protected $fillable = [
        'pre_action_protocol_id',
        'extended_on',
        'extended_to',
        'particulars',
    ];

    protected $casts = [
        'extended_on' => 'datetime:Y-m-d H:i',
        'extended_to' => 'datetime:Y-m-d H:i',
    ];

    protected static function newFactory(): PreActionProtocolExtensionFactory
    {
        return PreActionProtocolExtensionFactory::new();
    }

    public function preActionProtocol(): BelongsTo
    {
        return $this->belongsTo(PreActionProtocol::class);
    }
}
