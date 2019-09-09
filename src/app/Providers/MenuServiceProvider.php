<?php

namespace App\Providers;

use App\Models\{
    Chat, Role, User, Visitor, Workspace, WorkspaceApiKey
};
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\Telescope;

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
            ];

            // add role-based menu items
            if (\Auth::user()->hasRole(Role::SUPER_ADMIN)) {
                $menu = array_merge($menu, $this->getSuperAdminMenuItems());
            } else {
                $menu = array_merge($menu, $this->getWorkspacesUsersMenuItems());
            }

            $menu = array_merge($menu, $this->getDebugMenuItems());

            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }

    /**
     * Get menu items for Super Admin.
     *
     * @return array
     */
    protected function getSuperAdminMenuItems(): array
    {
        return [
            [
                'text' => trans('menu.workspaces'),
                'url' => route('admin::workspaces.index'),
                'icon' => 'laptop',
                'can' => 'viewAny',
                'model' => Workspace::class,
                'active' => [
                    route('admin::workspaces.index'),
                    route('admin::workspaces.index') . '*'
                ]
            ],
            [
                'text' => trans('menu.users'),
                'url' => route('admin::users.index'),
                'icon' => 'users',
                'can' => 'viewAny',
                'model' => User::class,
                'active' => [
                    route('admin::users.index'),
                    route('admin::users.index') . '*'
                ]
            ],
        ];
    }

    /**
     * Get menu items for Workspace user.
     *
     * @return array
     */
    protected function getWorkspacesUsersMenuItems(): array
    {
        return [
            [
                'text' => trans('menu.users'),
                'url' => route('workspace::users.index'),
                'icon' => 'users',
                'can' => 'viewAny',
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
                'can' => 'viewAny',
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
                'can' => 'viewAny',
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
                'can' => 'viewAny',
                'model' => Chat::class,
                'active' => [
                    route('workspace::chats.index'),
                    route('workspace::chats.index') . '*'
                ]
            ]
        ];
    }

    /**
     * Get menu items for debug.
     *
     * @return array
     */
    protected function getDebugMenuItems(): array
    {
        $items = [];
        if (Telescope::check(request())) {
            $items[] = [
                'text' => trans('menu.telescope'),
                'url' => route('telescope'),
                'icon' => 'binoculars',
                'target' => '_blank',
                'active' => [
                    route('telescope'),
                    route('telescope') . '?*'
                ]
            ];
        }

        return empty($items) ? [] : array_merge([
            mb_strtoupper(trans('menu.debugging'))
        ], $items);
    }
}
