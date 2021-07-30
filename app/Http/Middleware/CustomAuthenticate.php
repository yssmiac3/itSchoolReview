<?php


namespace App\Http\Middleware;

use App\Services\Token;
use Illuminate\Http\Request;
use Closure;

class CustomAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (! (new Token())->checkByToken($request->bearerToken())) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
