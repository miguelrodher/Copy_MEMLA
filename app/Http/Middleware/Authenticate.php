<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //dd("aqui");
        session(['url.intended' => $request->fullUrl()]);
        session(['form_data' => $request->except('_token')]); // Guarda los datos del formulario excepto el token CSRF


        return $request->expectsJson() ? null : route('login');
    }
}
