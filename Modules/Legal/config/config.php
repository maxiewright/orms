<?php

return [
    'name' => 'Legal',

    /*
     * The date and time formats used by the module
     */
    'timezones' => 'America/Port_of_Spain',

    'datetime' => 'd M Y \a\t\ Hi\h\r\s',

    'date' => 'd M Y',

    /*
     * The address classed used for all address fields in the module
     */
    'address' => [

        //    'country' => 'Trinidad and Tobago',

        'state' => \App\Models\Metadata\Contact\Division::class,

        'city' => \App\Models\Metadata\Contact\City::class,

    ],

];
