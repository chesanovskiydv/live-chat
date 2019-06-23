<?php

use App\Models\Role;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function (Router $router) {

    $router->auth();

    $router->group(['middleware' => ['auth']], function (Router $router) {

        /**
         * GET|HEAD      /                                               dashboard
         */
        $router->get('/', 'DashboardController')->name('dashboard');

        $router->group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin::'], function (Router $router) {
            /*
                 * "Super Admin" role section
                 */
            $router->group(['middleware' => ['role:' . Role::SUPER_ADMIN]], function (Router $router) {

                /**
                 * GET|HEAD      /admin/workspaces                                  admin::workspaces.index
                 * GET|HEAD      /admin/workspaces/{workspace}                      admin::workspaces.show
                 * GET|HEAD      /admin/workspaces/create                           admin::workspaces.create
                 * POST          /admin/workspaces/create                           admin::workspaces.store
                 * GET|HEAD      /admin/workspaces/{workspace}/edit                 admin::workspaces.edit
                 * PUT|PATCH     /admin/workspaces/{workspace}                      admin::workspaces.update
                 * DELETE        /admin/workspaces/{workspace}                      admin::workspaces.destroy
                 */
                $router->resource('workspaces', 'WorkspaceController');

                /**
                 * GET|HEAD      /admin/users                                       admin::users.index
                 * GET|HEAD      /admin/users/{user}                                admin::users.show
                 * GET|HEAD      /admin/users/create                                admin::users.create
                 * POST          /admin/users/create                                admin::users.store
                 * GET|HEAD      /admin/users/{user}/edit                           admin::users.edit
                 * PUT|PATCH     /admin/users/{user}                                admin::users.update
                 * DELETE        /admin/users/{user}                                admin::users.destroy
                 */
                $router->resource('users', 'UserController');
            });

        });

        $router->group(['namespace' => 'Workspace', 'as' => 'workspace::'], function (Router $router) {

            /*
             * "Admin" and "User" role section
             */
            $router->group(['middleware' => ['role:' . implode('|', [Role::ADMIN, Role::USER])]], function (Router $router) {

                /**
                 * GET|HEAD      /visitors                                          workspace::visitors.index
                 * GET|HEAD      /visitors/{visitor}                                workspace::visitors.show
                 * GET|HEAD      /visitors/create                                   workspace::visitors.create
                 * POST          /visitors/create                                   workspace::visitors.store
                 * GET|HEAD      /visitors/{visitor}/edit                           workspace::visitors.edit
                 * PUT|PATCH     /visitors/{visitor}                                workspace::visitors.update
                 * DELETE        /visitors/{visitor}                                workspace::visitors.destroy
                 */
                $router->resource('visitors', 'VisitorController');

                /**
                 * GET|HEAD      /chats                                             workspace::chats.index
                 */
                $router->resource('chats', 'ChatsController', [
                    'only' => ['index']
                ]);

                /**
                 * GET|HEAD      /chats/{chat}/messages                             workspace::chats.messages.index
                 * POST          /chats/{chat}/messages/create                      workspace::chats.messages.store
                 */
                $router->resource('chats.messages', 'MessagesController', [
                    'only' => ['index', 'store']
                ]);

            });

            /*
             * "Admin" role section
             */
            $router->group(['middleware' => ['role:' . Role::ADMIN]], function (Router $router) {

                /**
                 * GET|HEAD      /users                                         workspace::users.index
                 * GET|HEAD      /users/{user}                                  workspace::users.show
                 * GET|HEAD      /users/create                                  workspace::users.create
                 * POST          /users/create                                  workspace::users.store
                 * GET|HEAD      /users/{user}/edit                             workspace::users.edit
                 * PUT|PATCH     /users/{user}                                  workspace::users.update
                 * DELETE        /users/{user}                                  workspace::users.destroy
                 */
                $router->resource('users', 'UserController');

                /**
                 * GET|HEAD      /api-keys                                      workspace::api-keys.index
                 * GET|HEAD      /api-keys/{api_key}                            workspace::api-keys.show
                 * GET|HEAD      /api-keys/create                               workspace::api-keys.create
                 * POST          /api-keys/create                               workspace::api-keys.store
                 * GET|HEAD      /api-keys/{api_key}/edit                       workspace::api-keys.edit
                 * PUT|PATCH     /api-keys/{api_key}                            workspace::api-keys.update
                 * DELETE        /api-keys/{api_key}                            workspace::api-keys.destroy
                 */
                $router->resource('api-keys', 'ApiKeyController');
            });

        });

    });

});