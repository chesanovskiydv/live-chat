<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
    $trail->push(trans(route_name_to_translation_key('dashboard')), route('dashboard'));
});

Breadcrumbs::macro('resource', function ($name) {
    // Index
    if (Route::has("{$name}.index")) {
        Breadcrumbs::for ("{$name}.index", function ($trail) use ($name) {
            /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
            $trail->parent('dashboard');
            $trail->push(trans(route_name_to_translation_key("{$name}.index")) , route("{$name}.index"));
        });
    }

    // Create
    if (Route::has("{$name}.create")) {
        Breadcrumbs::for ("{$name}.create", function ($trail) use ($name) {
            /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
            $trail->parent(Route::has("{$name}.index") ? "{$name}.index" : "dashboard");
            $trail->push(trans(route_name_to_translation_key("{$name}.create")), route("{$name}.create"));
        });
    }

    // Show
    if (Route::has("{$name}.show")) {
        Breadcrumbs::for ("{$name}.show", function ($trail, $model) use ($name) {
            /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
            $trail->parent(Route::has("{$name}.index") ? "{$name}.index" : "dashboard");
            $trail->push(trans(route_name_to_translation_key("{$name}.show")), route("{$name}.show", $model));
        });
    }

    // Edit
    if (Route::has("{$name}.edit")) {
        Breadcrumbs::for ("{$name}.edit", function ($trail, $model) use ($name) {
            /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
            $trail->parent(Arr::first(["{$name}.show", "{$name}.index"], function ($routeName) {
                    return Route::has($routeName);
                }) ?? "dashboard", $model);
            $trail->push(trans(route_name_to_translation_key("{$name}.edit")), route("{$name}.edit", $model));
        });
    }
});

Breadcrumbs::resource('admin::workspaces');
Breadcrumbs::resource('admin::users');
