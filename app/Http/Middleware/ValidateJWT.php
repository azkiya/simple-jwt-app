<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\JWTService;

class ValidateJWT
{
    protected $jwtService;
    public function __construct(JWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();  // Get token from the Authorization header

        if (!$token || !$this->jwtService->validateToken($token)) {
            return response()->json(['error' => 'Unauthorized'], 401);  // Return error if token is invalid
        }

        // If token is valid, pass the request
        return $next($request);
    }
}
