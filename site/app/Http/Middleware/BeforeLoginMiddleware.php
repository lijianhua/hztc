<?php namespace App\Http\Middleware;
use Redirect;
use Closure;
use Auth;
class BeforeLoginMiddleware {

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $user = Auth::user();
    if ($user)
    {
        if ($user->confirmed == 0)
        {
          $email = $user->email; 
          $id = $user->id;
          Auth::logout();
          return Redirect::to('auth/email/'.$id);
        }
        else
        {
          return $next($request);
        }
    }
    else
    {
        return $next($request);
    }
  }

}
