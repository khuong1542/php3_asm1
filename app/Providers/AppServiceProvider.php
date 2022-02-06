<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('admin.layouts.sidebar', function ($view) {
            $login = Auth::user();
            $sidebar = [];
            if ($login->role_id == 1) {
                $sidebar = [
                    [
                        'id' => 1,
                        'name' => 'Xe',
                        'icon' => 'fas fa-car',
                        'url' => route('cars.index'),
                        'child' => [
                            [
                                'name' => 'Danh sách',
                                'icon' => 'far fa-circle',
                                'url' => route('cars.index'),
                            ], [
                                'name' => 'Thêm mới',
                                'icon' => 'far fa-circle',
                                'url' => route('cars.create'),
                            ]
                        ]
                    ],
                    [
                        'id' => 2,
                        'name' => 'Khách',
                        'icon' => 'fas fa-clipboard-list',
                        'url' => route('passengers.index'),
                        'child' => [
                            [
                                'name' => 'Danh sách',
                                'icon' => 'far fa-circle',
                                'url' => route('passengers.index'),
                            ], [
                                'name' => 'Thêm mới',
                                'icon' => 'far fa-circle',
                                'url' => route('passengers.create'),
                            ]
                        ]
                    ],
                    [
                        'id' => 3,
                        'name' => 'Tài khoản',
                        'icon' => 'fas fa-users',
                        'url' => 'javascript:;',
                        'child' => [
                            [
                                'name' => 'Quản trị',
                                'icon' => 'far fa-circle',
                                'url' => route('admin.list'),
                            ],[
                                'name' => 'Nhân viên',
                                'icon' => 'far fa-circle',
                                'url' => route('staffs.index'),
                            ],[
                                'name' => 'Khách hàng',
                                'icon' => 'far fa-circle',
                                'url' => route('members.index'),
                            ],
                        ]
                    ]
                ];
            }else{
                
                $sidebar = [
                    [
                        'id' => 1,
                        'name' => 'Xe',
                        'icon' => 'fas fa-car',
                        'url' => route('cars.index'),
                        'child' => [
                            [
                                'name' => 'Danh sách',
                                'icon' => 'far fa-circle',
                                'url' => route('cars.index'),
                            ], [
                                'name' => 'Thêm mới',
                                'icon' => 'far fa-circle',
                                'url' => route('cars.create'),
                            ]
                        ]
                    ],
                    [
                        'id' => 2,
                        'name' => 'Khách',
                        'icon' => 'fas fa-clipboard-list',
                        'url' => route('passengers.index'),
                        'child' => [
                            [
                                'name' => 'Danh sách',
                                'icon' => 'far fa-circle',
                                'url' => route('passengers.index'),
                            ], [
                                'name' => 'Thêm mới',
                                'icon' => 'far fa-circle',
                                'url' => route('passengers.create'),
                            ]
                        ]
                    ],
                    [
                        'id' => 3,
                        'name' => 'Tài khoản',
                        'icon' => 'fas fa-users',
                        'url' => 'javascript:;',
                        'child' => [
                            [
                                'name' => 'Quản trị',
                                'icon' => 'far fa-circle',
                                'url' => route('admin.list'),
                            ],[
                                'name' => 'Nhân viên',
                                'icon' => 'far fa-circle',
                                'url' => route('staffs.index'),
                            ],[
                                'name' => 'Khách hàng',
                                'icon' => 'far fa-circle',
                                'url' => route('members.index'),
                            ],
                        ]
                    ]
                ];
            }
            $view->with('custom_sidebar', $sidebar);
        });
    }
}
