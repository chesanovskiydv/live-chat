<?php
// @todo: translations !!!!
// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::macro('resource', function ($name, $title) {
    // Home > Blog
    Breadcrumbs::for("{$name}.index", function ($trail) use ($name, $title) {
        /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
        $trail->parent('dashboard');
        $trail->push($title, route("{$name}.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("{$name}.create", function ($trail) use ($name) {
        /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
        $trail->parent("{$name}.index");
        $trail->push('New', route("{$name}.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("{$name}.show", function ($trail, $model) use ($name) {
        /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
        $trail->parent("{$name}.index");
        $trail->push($model->title, route("{$name}.show", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("{$name}.edit", function ($trail, $model) use ($name) {
        /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
        $trail->parent("{$name}.show", $model);
        $trail->push('Edit', route("{$name}.edit", $model));
    });
});

Breadcrumbs::resource('workspaces', trans_choice('workspace.workspace', PHP_INT_MAX));

//Breadcrumbs::for('workspaces.index', function ($trail) {
//    /** @var DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator $trail */
//    $trail->parent('dashboard');
//    $trail->push(trans_choice('workspace.workspace', PHP_INT_MAX), route('workspaces.index'));
//});
