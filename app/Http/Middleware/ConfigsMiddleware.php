<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ConfigsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setLocalte($request);

        return $next($request);
    }

    private function setLocalte($request)
    {
        $locale = explode(",", $request->server('HTTP_ACCEPT_LANGUAGE'));

        $lang = "en";
        if(!empty($locale[0])){
            switch ($locale[0]){
                case 'pt' :
                case 'pt-BR' :
                    $lang = "pt-BR";
                    break;
            }
        }

        App::setLocale($lang);
    }
}
