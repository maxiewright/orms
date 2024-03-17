<?php

return [

    'name' => 'ServiceFund',

    /*
     * The company/user class that the account belongs to.
     */
    'user' => [
        'model' => \App\Models\Serviceperson::class,
        'id' => 'number',
        'search_columns' => ['number', 'first_name', 'middle_name', 'last_name'],
        'auth' => [
            'model' => \App\Models\User::class,
            'id' => 'id',
        ],
    ],

    /*
     * The company/user class that the account belongs to.
     */

    'company' => [
        'model' => \App\Models\Unit\Company::class,
        'id' => 'id',
        'title-attribute' => 'name',
    ],

    /*
     * The address that will be used for contacts that has transactions
     */
    'address' => [
        'city' => \App\Models\Metadata\Contact\City::class,
    ],

    /*
     * The data and time formats to be used in the app.
     */

    'timestamp' => [
        'time' => 'H:i A',
        'date' => 'D d M Y',
        'datetime' => 'D, d M Y - H:i A',
    ],

    'timezone' => 'America/Port_of_Spain',

    'currency' => 'TTD',

];
