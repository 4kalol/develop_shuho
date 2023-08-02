<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    // Users
    protected $user_route = 'user.login';
    // Admins
    protected $admin_route = 'admin.login';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // del --->
            //return route('login');
            // del <---

            
            if(Route::is('admin.*')){
                return route($this->admin_route);
            }
            else {
                return route($this->user_route);
            }
        }
    }
}
