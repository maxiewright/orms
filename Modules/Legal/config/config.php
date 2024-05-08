<?php

return [
    'name' => 'Legal',

    /*
     * The accused model and database table
     */
    'accused' => [

        'class' => \App\Models\Serviceperson::class,

        'database_table' => 'servicepeople',

        'id' => 'number',
    ],

    /*
     * The address classed used for all address fields in the module
     */
    'address' => [

        //    'country' => 'Trinidad and Tobago',

        'state' => \App\Models\Metadata\Contact\Division::class,

        'city' => \App\Models\Metadata\Contact\City::class,

    ],

];
