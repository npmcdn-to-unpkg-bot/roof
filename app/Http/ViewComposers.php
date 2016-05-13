<?php 

view()->composer('public.catalog.association', 'App\Http\ViewComposers\AssociationBlock');
view()->composer('public.polls.block', 'App\Http\ViewComposers\PollsBlock');
view()->composer('public.desk.block', 'App\Http\ViewComposers\DeskBlock');
view()->composer('public.events.block', 'App\Http\ViewComposers\Calendar');
view()->composer('public.events.index', 'App\Http\ViewComposers\Calendar');
view()->composer('public.desk.top', 'App\Http\ViewComposers\TopOffers');

view()->composer('admin.parts.menu', 'App\Http\ViewComposers\AdminMenu');