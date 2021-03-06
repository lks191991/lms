<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RouteNeedsRole.
 */
class RouteNeedsRole
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     * @param bool $needsAll
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $needsAll = false)
    {
        /*
         * Roles array
         */
        if (strpos($role, ';') !== false) {
            $roles = explode(';', $role);
            $access = \Auth::user()->hasRoles($roles, ($needsAll === 'true' ? true : false));
        } else {
            /**
             * Single role.
             */
            $access = \Auth::user()->hasRole($role);
        }

        if (!$access) {
            abort(403, 'Unauthorized access.');
//           return redirect()
//                ->route('frontend.index')
//                ->withFlashDanger('You are not autherized to access this page.');
        }

        return $next($request);
    }
}
