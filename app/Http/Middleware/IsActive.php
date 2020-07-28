<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsActive
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
        // if (!Auth::user()->is_active) {
        if (!Auth::guard('member')->user()->is_active) {
            \Toastr::error('Vous ne pouvez pas accèder aux documents car votre compte n\'est pas encore actif. Après l\'inscription, l\'activation prend généralement un jour ouvrable. N\'hésitez pas à nous <a href=\'#contact\'><u>contacter</u></a> pour avoir plus d\'informations.', "Erreur", ["timeOut" => 10000]);
            return redirect('home');
        }
        return $next($request);
    }
}
