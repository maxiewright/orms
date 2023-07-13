<?php

namespace App\Filament\Pages;


use JeffGreco13\FilamentBreezy\Pages\MyProfile as BaseProfile;

use Filament\Pages\Page;

class MyProfile extends BaseProfile
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-profile';


}
