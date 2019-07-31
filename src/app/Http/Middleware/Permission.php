<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Laratrust\Middleware\LaratrustPermission;

class Permission extends LaratrustPermission
{
    /**
     * @inheritdoc
     */
    public function handle($request, Closure $next, $permissions, $team = null, $options = '')
    {
        list($realTeam, , $guard) = $this->assignRealValuesTo($team, $options);

        if (is_null($realTeam) && Auth::guard($guard)->check()) {
            $team = Auth::guard($guard)->user()->activeWorkspace();
        }

        return parent::handle($request, $next, $permissions, $team, $options);
    }
}
