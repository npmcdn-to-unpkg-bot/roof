<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */
   
    'route' => 'imagecache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        storage_path('app/images/'),
        storage_path('app/temp/')
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */
   
    'templates' => array(
        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        'full' => 'App\Filters\Full',
        '85x85' => 'App\Filters\Filter85x85',
        '120x120' => 'App\Filters\Filter120x120',
        '240x200' => 'App\Filters\Filter240x200',
        '370x200' => 'App\Filters\Filter370x200',
        '765x400' => 'App\Filters\Filter765x400',
        '160x140' => 'App\Filters\Filter160x140',
        '120x85' => 'App\Filters\Filter120x85',
        '175x200' => 'App\Filters\Filter175x200',
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
   
    'lifetime' => 43200,

);
