<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Event broadcasting channels for the legal module
|
*/

Broadcast::channel('preActionProtocols.{preActionProtocol}', function (User $user) {
    return true;
//    return $user->hasAnyRole(['super_admin', 'legal_clerk', 'legal_manager', 'legal_officer']);
});
