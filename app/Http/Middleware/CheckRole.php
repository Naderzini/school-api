<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Model\Admin;


class CheckRole
{
    const ROLES = [
        Admin::ROLE_SUPER_ADMIN => 'superadmin',
        Admin::ROLE_ADMIN       => 'admin',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @param array ...$roles
     *
     * @return jsonResponse
     */

    public function handle($request, Closure $next, ...$roles)
    {
        $authUserRole = self::ROLES[auth()->user()->role] ?? '';
        if (in_array($authUserRole, $roles)) {
            return $next($request);
        }
        return response()->json([ 'status' => 'error', 'message' => 'common:access:error' ], 403);

    }
}
