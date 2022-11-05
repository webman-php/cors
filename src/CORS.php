<?php
namespace Webman\Cors;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class CORS implements MiddlewareInterface
{
    public function process(Request $request, callable $next) : Response
    {
        $response = $request->method() == 'OPTIONS' ? response('') : $next($request);
        $response->withHeaders([
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Origin' => $request->header('origin', '*'),
            'Access-Control-Allow-Methods' => $request->header('access-control-request-method', '*'),
            'Access-Control-Allow-Headers' => $request->header('access-control-request-headers', '*'),
        ]);

        return $response;
    }
}
