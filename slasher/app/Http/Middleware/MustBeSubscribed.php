<?php

namespace App\Http\Middleware;

use Closure;

class MustBeSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $plan)
    {
        $user = $request->user();
        $id = ($request->route('id'));
;
        if($user && $user->IsSubscribed($plan)){
            return $next($request);
        }
        return redirect('/');
    }
}
