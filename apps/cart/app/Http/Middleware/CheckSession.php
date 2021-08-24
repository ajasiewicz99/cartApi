<?php namespace App\Http\Middleware;

use App\Models\Transformers\ResponseTransformer;
use Closure;
use Illuminate\Http\JsonResponse;

class CheckSession
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
        $cachedCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        if(!$cachedCart) {
            return ResponseTransformer::responseWithArray(JsonResponse::HTTP_NOT_FOUND,['message' =>'Cart is empty!']);
        }
        return $next($request);
    }
}
