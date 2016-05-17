<?php 

view()->composer( 'general.catalog.association',     'App\Http\ViewComposers\AssociationBlock'    );
view()->composer( 'general.polls.block',             'App\Http\ViewComposers\PollsBlock'          );
view()->composer( 'general.desk.block',              'App\Http\ViewComposers\DeskBlock'           );
view()->composer( 'general.events.block',            'App\Http\ViewComposers\Calendar'            );
view()->composer( 'general.events.index',            'App\Http\ViewComposers\Calendar'            );
view()->composer( 'general.desk.top',                'App\Http\ViewComposers\TopOffers'           );

view()->composer( 'admin.parts.menu',                'App\Http\ViewComposers\AdminMenu'           );