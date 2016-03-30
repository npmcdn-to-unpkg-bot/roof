<?php 

view()->composer('user.control', 'App\Http\ViewComposers\UserControlComposer');
view()->composer('public.catalog.association', 'App\Http\ViewComposers\PublicAssociationComposer');