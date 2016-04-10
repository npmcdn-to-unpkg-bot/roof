<?php 

view()->composer('user.layout', 'App\Http\ViewComposers\UserLayoutComposer');
view()->composer('public.catalog.association', 'App\Http\ViewComposers\PublicAssociationComposer');