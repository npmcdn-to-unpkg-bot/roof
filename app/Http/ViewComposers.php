<?php 

view()->composer('general.desktop.catalog.association', 'App\Http\ViewComposers\AssociationBlock');
view()->composer('general.desktop.polls.block', 'App\Http\ViewComposers\PollsBlock');
view()->composer('general.desktop.desk.block', 'App\Http\ViewComposers\DeskBlock');
view()->composer('general.desktop.events.block', 'App\Http\ViewComposers\Calendar');
view()->composer('general.desktop.events.index', 'App\Http\ViewComposers\Calendar');
view()->composer('general.desktop.desk.top', 'App\Http\ViewComposers\TopOffers');

view()->composer('general.mobile.catalog.association', 'App\Http\ViewComposers\AssociationBlock');
view()->composer('general.mobile.polls.block', 'App\Http\ViewComposers\PollsBlock');
view()->composer('general.mobile.desk.block', 'App\Http\ViewComposers\DeskBlock');
view()->composer('general.mobile.events.block', 'App\Http\ViewComposers\Calendar');
view()->composer('general.mobile.events.index', 'App\Http\ViewComposers\Calendar');
view()->composer('general.mobile.desk.top', 'App\Http\ViewComposers\TopOffers');

view()->composer('admin.parts.menu', 'App\Http\ViewComposers\AdminMenu');