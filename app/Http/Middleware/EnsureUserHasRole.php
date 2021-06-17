<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()->role !== $role && $request->user()->role === $this->getAdministratorKeyName()) {
            return redirect()->route($this->getUserHomeRouteName());
        } else if ($request->user()->role !== $role && $request->user()->role === $this->getUserKeyName()) {
            return redirect()->route($this->getAdminHomeRouteName());
        }

        return $next($request);
    }

    /**
     * Get Administrator role name in database.
     *
     * @return string
     */
    private function getAdministratorKeyName()
    {
        return 'Administrator';
    }

    /**
     * Get Administrator route name for home page.
     *
     * @return string
     */
    private function getAdminHomeRouteName()
    {
        return 'admin.home';
    }

    /**
     * Get User role name in database.
     *
     * @return string
     */
    private function getUserKeyName()
    {
        return 'User';
    }

    /**
     * Get User route name for home page.
     *
     * @return string
     */
    private function getUserHomeRouteName()
    {
        return 'home';
    }
}
