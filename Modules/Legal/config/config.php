<?php

return [
    'name' => 'Legal',

    /*
     * The accused model and database table
     */

    'timezones' => 'America/Port_of_Spain',
    'datetime_format' => 'D d M y, H:i',
    'date_format' => 'Y-m-d',

    /*
     * The address classed used for all address fields in the module
     */
    'address' => [

        //    'country' => 'Trinidad and Tobago',

        'state' => \App\Models\Metadata\Contact\Division::class,

        'city' => \App\Models\Metadata\Contact\City::class,

    ],

];
