<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $user = $request->user();

    if (!($user->admin && $user->id == 1)) {
      Auth::logout();

      if ($request->ajax()) {
        return response('Unauthorized.', 401);
      } else {
        return redirect()->guest('auth/login');
      }
    }

    return $next($request);
  }
}
