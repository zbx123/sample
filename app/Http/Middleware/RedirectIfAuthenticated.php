<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //已登陆用户不允许访问登陆以及注册页面,登陆时会报错，所以设置重定向
            //return redirect('/home');
            session()->flash('info','您已经成功登陆，无需再次操作');
            return redirect('/');
        }

        return $next($request);
    }
}
