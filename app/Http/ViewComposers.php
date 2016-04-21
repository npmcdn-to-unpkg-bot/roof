<?php 

view()->composer('public.catalog.association', 'App\Http\ViewComposers\AssociationBlock');
view()->composer('public.polls.block', 'App\Http\ViewComposers\PollsBlock');
view()->composer('public.news.block', 'App\Http\ViewComposers\NewsBlock');
view()->composer('public.news.block2', 'App\Http\ViewComposers\NewsBlock2');
view()->composer('public.desk.block', 'App\Http\ViewComposers\DeskBlock');
view()->composer('public.calendar.block', 'App\Http\ViewComposers\Calendar');

view()->composer('admin.menu', 'App\Http\ViewComposers\AdminMenu');