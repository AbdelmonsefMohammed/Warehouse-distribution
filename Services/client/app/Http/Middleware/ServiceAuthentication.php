<?php

declare(strict_type=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

final class ServiceAuthentication
{
    
    public function handle(Request $request, Closure $next): Response
    {
        // does the request have an auth header ? 
        if (! $request->hasHeader('Authorization')) 
        {
            throw new AuthenticationException(
                message: 'Please include your access token in the request.',
                guards: ['api'], 
            );
            
        }

        // extract the token from the header

        $token = Str::of(
            string: $request->header('Authorization'),
        )->after(
            search: 'Bearer ',
        )->toString();

        // check the token against our cache

        if (! $identity = Redis::get($token)) 
        {
            throw new AuthenticationException(
                message: 'Invalid Authentication.',
                guards: ['api'], 
            );
        }

        $request->merge([
            'identity'  => json_decode(
                json: $identity,
                associative: true,
                flags: JSON_TROW_ON_ERROR,
            )
        ]);

        return $next($request);
    }
}
