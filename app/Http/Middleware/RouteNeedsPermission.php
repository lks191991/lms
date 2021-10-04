<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RouteNeedsRole.
 */
class RouteNeedsPermission
{
    /**
     * @param $request
     * @param Closure $next
     * @param $permission
     * @param bool $needsAll
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $needsAll = false)
    {
        /*
         * Permission array
         */
        if (strpos($permission, ';') !== false) {
            $permissions = explode(';', $permission);
            $access = \Auth::user()->hasAllPermissions($permissions, ($needsAll === 'true' ? true : false));
        } else {
            /**
             * Single permission.
             */
            $access = \Auth::user()->hasPermission($permission);
        }

        if (!$access) {
            abort(403, 'Unauthorized access.');
//            return redirect()
//                ->route('frontend.index')
//                ->withFlashDanger('You are not autherized to access this page.');
        }

        return $next($request);
    }
}
