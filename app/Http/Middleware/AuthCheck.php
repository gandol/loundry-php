<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use MiladRahimi\Jwt\Cryptography\Algorithms\Hmac\HS256;
use MiladRahimi\Jwt\Parser;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            //parse the jwt token
            $token = explode(' ', $request->header('Authorization'))[1];
            $signKey = new HS256(env('JWT_SECRET'));
            $parser = new Parser($signKey);
            $claims = $parser->parse($token);
            //check if token is valid
            $request->attributes->add(['user_id' =>$claims['user_id']]);
            return $next($request);
        }catch (\Exception $e){
            dd($e);
//            return redirect('/login');
        }
        //check if request has auth bearer token

    }
}
