<?php

namespace App\Providers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Workspace;
use App\Models\WorkspaceApiKey;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;
use Illuminate\Support\ServiceProvider;

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
                [
                    'text' => trans('menu.dashboard'),
                    'url' => route('dashboard'),
                    'icon' => 'dashboard',
                    'active' => [
                        route('dashboard'),
                    ]
                ],
                [
                    'text' => trans('menu.workspaces'),
                    'url' => route('workspaces.index'),
                    'icon' => 'laptop',
                    'can' => 'list',
                    'model' => Workspace::class,
                    'active' => [
                        route('workspaces.index'),
                        route('workspaces.index') . '*'
                    ]
                ],
                [
                    'text' => trans('menu.users'),
                    'url' => route('workspace::users.index'),
                    'icon' => 'users',
                    'can' => 'list',
                    'model' => User::class,
                    'active' => [
                        route('workspace::users.index'),
                        route('workspace::users.index') . '*'
                    ]
                ],
                [
                    'text' => trans('menu.api_keys'),
                    'url' => route('workspace::api-keys.index'),
                    'icon' => 'key',
                    'can' => 'list',
                    'model' => WorkspaceApiKey::class,
                    'active' => [
                        route('workspace::api-keys.index'),
                        route('workspace::api-keys.index') . '*'
                    ]
                ],
                [
                    'text' => trans('menu.visitors'),
                    'url' => route('workspace::visitors.index'),
                    'icon' => 'users',
                    'can' => 'list',
                    'model' => Visitor::class,
                    'active' => [
                        route('workspace::visitors.index'),
                        route('workspace::visitors.index') . '*'
                    ]
                ],
                [
                    'text' => trans('menu.chats'),
                    'url' => route('workspace::chats.index'),
                    'icon' => 'comments-o',
                    'can' => 'list',
                    'model' => Chat::class,
                    'active' => [
                        route('workspace::chats.index'),
                        route('workspace::chats.index') . '*'
                    ]
                ]
            ];

            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}
