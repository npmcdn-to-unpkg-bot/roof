<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Request;
use Auth;

class AdminMenu
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
	public function compose (View $view) {

        $user = Auth::user();

        if (Request::is('user*'))
            $menu = [
                [
                    'name' => 'Объявления',
                    'icon' => 'fa-file-image-o',
                    'active' => Request::is('user/offers*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список объявлений',
                            'icon' => 'fa-list',
                            'href' => route('user.offers.index'),
                        ],[
                            'name' => 'Добавить объявление',
                            'icon' => 'fa-plus',
                            'href' => route('user.offers.create'),
                        ],
                    ],
                ],[
                    'name' => 'Компания',
                    'icon' => 'fa-bank',
                    'active' => Request::is('user/company*')?'active':'',
                    'children' => [
                        [
                            'name' => $user->company ? $user->company->name : 'Добавить компанию',
                            'icon' => 'fa-plus',
                            'href' => url('user'),
                        ],
                    ],
                ],
            ];

        if (Request::is('user*')&&Auth::user()->company)
            $menu = array_merge($menu,[
                [
                    'name' => 'Стройки',
                    'icon' => 'fa-building',
                    'active' => Request::is('user/building*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список строек',
                            'icon' => 'fa-list',
                            'href' => route('user.building.index'),
                        ],[
                            'name' => 'Добавить стройку',
                            'icon' => 'fa-plus',
                            'href' => route('user.building.create'),
                        ],
                    ],
                ],[
                    'name' => 'Новости',
                    'icon' => 'fa-newspaper-o',
                    'active' => Request::is('user/news*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список новостей',
                            'icon' => 'fa-list',
                            'href' => route('user.news.index'),
                        ],[
                            'name' => 'Добавить новость',
                            'icon' => 'fa-plus',
                            'href' => route('user.news.create'),
                        ],
                    ],
                ],[
                    'name' => 'Акции',
                    'icon' => 'fa-percent',
                    'active' => Request::is('user/sales*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список акций',
                            'icon' => 'fa-list',
                            'href' => route('user.sales.index'),
                        ],[
                            'name' => 'Добавить акцию',
                            'icon' => 'fa-plus',
                            'href' => route('user.sales.create'),
                        ],
                    ],
                ]
            ]);

        if (Request::is('admin*'))
            $menu = [
                [
                    'name' => 'Компании',
                    'icon' => 'fa-bank',
                    'active' => Request::is('admin/company*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список компаний',
                            'icon' => 'fa-list',
                            'href' => route('admin.company.index'),
                        ],
                        [
                            'name' => 'Добавить компанию',
                            'icon' => 'fa-plus',
                            'href' => route('admin.company.create'),
                        ],
                    ],
                ],[
                    'name' => 'Стройки',
                    'icon' => 'fa-building',
                    'active' => Request::is('admin/building*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список строек',
                            'icon' => 'fa-list',
                            'href' => route('admin.building.index'),
                        ],[
                            'name' => 'Добавить стройку',
                            'icon' => 'fa-plus',
                            'href' => route('admin.building.create'),
                        ],
                    ],
                ],[
                    'name' => 'Новости',
                    'icon' => 'fa-newspaper-o',
                    'active' => Request::is('admin/news*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список новостей',
                            'icon' => 'fa-list',
                            'href' => route('admin.news.index'),
                        ],[
                            'name' => 'Добавить новость',
                            'icon' => 'fa-plus',
                            'href' => route('admin.news.create'),
                        ],
                    ],
                ],[
                    'name' => 'Акции и скидки',
                    'icon' => 'fa-percent',
                    'active' => Request::is('admin/sales*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список акций',
                            'icon' => 'fa-list',
                            'href' => route('admin.sales.index'),
                        ],[
                            'name' => 'Добавить акцию',
                            'icon' => 'fa-plus',
                            'href' => route('admin.sales.create'),
                        ],
                    ],
                ],[
                    'name' => 'Опросы',
                    'icon' => 'fa-question',
                    'active' => Request::is('admin/polls*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список опросов',
                            'icon' => 'fa-list',
                            'href' => route('admin.polls.index'),
                        ],[
                            'name' => 'Добавить опрос',
                            'icon' => 'fa-plus',
                            'href' => route('admin.polls.create'),
                        ],
                    ],
                ],[
                    'name' => 'Объявления',
                    'icon' => 'fa-file-image-o',
                    'active' => Request::is('admin/offers*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список объявлений',
                            'icon' => 'fa-list',
                            'href' => route('admin.offers.index'),
                        ],[
                            'name' => 'Добавить объявление',
                            'icon' => 'fa-plus',
                            'href' => route('admin.offers.create'),
                        ],
                    ],
                ],[
                    'name' => 'Банеры',
                    'icon' => 'fa-file-image-o',
                    'active' => Request::is('admin/banners*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список банеров',
                            'icon' => 'fa-list',
                            'href' => route('admin.banners.index'),
                        ],[
                            'name' => 'Добавить банер',
                            'icon' => 'fa-plus',
                            'href' => route('admin.banners.create'),
                        ],
                    ],
                ],[
                    'name' => 'Пользователи',
                    'icon' => 'fa-user',
                    'active' => Request::is('admin/company*')?'active':'',
                    'children' => [
                        [
                            'name' => 'Список пользователей',
                            'icon' => 'fa-list',
                            'href' => route('admin.company.index'),
                        ],[
                            'name' => 'Добавить пользователя',
                            'icon' => 'fa-plus',
                            'href' => route('admin.company.create'),
                        ],
                    ],
                ],
            ];
        return $view->with('menu', $menu);
    }
}

