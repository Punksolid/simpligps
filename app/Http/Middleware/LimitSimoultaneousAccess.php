<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Collection;

class LimitSimoultaneousAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $account = auth()->user()->accounts()->firstOrFail();//TODO make dinamic
            $user_logged = \Auth::user();

            if (\Cache::has("active_sessions_$account->id")) {

                $existent = \Cache::get("active_sessions_$account->id");
                $colleagues_without_auth = $existent->reject(function ($user) use($user_logged){

                    return $user->email === $user_logged->email;

                });
                $colleagues = $colleagues_without_auth->push(auth()->user());

            } else {
                $colleagues = new Collection([auth()->user()]);
            }

            \Cache::set("active_sessions_$account->id",$colleagues, 60);

            $active_sessions = cache("active_sessions_$account->id")->count();

            $limit_active_sessions = $account->activeLicenses()->firstOrFail()->number_active_sessions;

            if ($active_sessions > $limit_active_sessions){
                abort(401, "Demasiadas sesiones activas, superó su limite de $limit_active_sessions sesiones activas");
            }
        }catch (\Exception $e){
            abort(401, "Se encontró un error con su licencia, favor de contactar al administrador.");
        }

        //@Todo logica de no más de una sesion activa
        return $next($request);
    }
}
