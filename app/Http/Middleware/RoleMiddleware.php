<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Http\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role, string $permission = null)
    {
        /** 
         * checking if user has access to this role
         */
        if (!$request->user()->hasRole($role))
        {
            return response()->json([
                'data' => [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => __('unauthorized!')
                ]
            ], Response::HTTP_NOT_FOUND);

        }
        /**
         * check if user belongs to this permissions 
         */
        if ($permission !== null && !$request->user()->can($permission))
        {
            return response()->json([
                'data' => [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => __('unauthorized!')
                ]
            ], Response::HTTP_NOT_FOUND);

        }
        return $next($request);
    }
}
