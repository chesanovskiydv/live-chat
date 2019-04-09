<?php

namespace App\Providers;

use App\Models\Category as CategoryModel;
use App\Models\Client as ClientModel;
use App\Models\Keyword as KeywordModel;
use App\Models\Product as ProductModel;
use App\Models\ParserSession as ParserSessionModel;
use App\Models\ProductData as ProductDataModel;
use App\Models\Retailer as RetailerModel;
use App\Models\User as UserModel;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;
use Illuminate\Support\ServiceProvider;
use App\Jobs\LinkMonitor\Categories\Data as DataCategoriesLinksJob;
use App\Jobs\LinkMonitor\Products\Data as DataProductLinksJob;
use App\Jobs\LinkMonitor\UnmonitoredProducts\Data as DataUntrackedProductLinksJob;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param EventsDispatcher $events
     *
     * @return void
     */
    public function boot(EventsDispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $menu = [
                'MAIN NAVIGATION',
                [
                    'text' => 'Blog',
                    'url' => 'admin/blog',
                    'can' => 'manage-blog',
                ],
                [
                    'text' => 'Pages',
                    'url' => 'admin/pages',
                    'icon' => 'file',
                    'label' => 4,
                    'label_color' => 'success',
                ],
                'ACCOUNT SETTINGS',
                [
                    'text' => 'Profile',
                    'url' => 'admin/settings',
                    'icon' => 'user',
                ],
                [
                    'text' => 'Change Password',
                    'url' => 'admin/settings',
                    'icon' => 'lock',
                ],
                [
                    'text' => 'Multilevel',
                    'icon' => 'share',
                    'submenu' => [
                        [
                            'text' => 'Level One',
                            'url' => '#',
                        ],
                        [
                            'text' => 'Level One',
                            'url' => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Two',
                                    'url' => '#',
                                ],
                                [
                                    'text' => 'Level Two',
                                    'url' => '#',
                                    'submenu' => [
                                        [
                                            'text' => 'Level Three',
                                            'url' => '#',
                                        ],
                                        [
                                            'text' => 'Level Three',
                                            'url' => '#',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'text' => 'Level One',
                            'url' => '#',
                        ],
                    ],
                ],
                'LABELS',
                [
                    'text' => 'Important',
                    'icon_color' => 'red',
                ],
                [
                    'text' => 'Warning',
                    'icon_color' => 'yellow',
                ],
                [
                    'text' => 'Information',
                    'icon_color' => 'aqua',
                ],
            ];

            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}
