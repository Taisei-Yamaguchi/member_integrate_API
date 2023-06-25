<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;

//2023.6.24 APIrequestを認証するミドルウェア
class APIAuthentificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         // リクエストからpublic IDとsecret keyを取得
         $publicId = $request->header('X-Public-ID');
         $secretKey = $request->header('X-Secret-Key');
 
         // configから登録したpublic IDとsecret keyを取得
         $registeredPublicId = Config::get('app.api_public_id');
         $registeredSecretKey = Config::get('app.api_secret_key');
 
         // public IDとsecret keyが一致しない場合はエラーレスポンスを返す
         if ($publicId !== $registeredPublicId || $secretKey !== $registeredSecretKey) {
             return response()->json(['error' => 'Invalid credentials'], 401);
         }
 
         return $next($request);
        
    }
}
