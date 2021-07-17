<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require_once dirname(__DIR__).'/vendor/autoload.php';

/**
 * 整站通用的常量定义
 */
require_once dirname(__DIR__).'/config/defined.php';

$request=Request::createFromGlobals();

$routes=include dirname(__DIR__).'/config/routes.php';

$context=new RequestContext();
$context->fromRequest($request);

$matcher=new UrlMatcher($routes,$context);

$controllerResolver=new ControllerResolver();
$argumentResolver=new ArgumentResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
} catch (ResourceNotFoundException $e) {
    $request->attributes->add($matcher->match('/404'));
    $request->attributes->add(['error'=>$e]);
} catch (\Throwable $th) {
    $request->attributes->add($matcher->match('/500'));
    $request->attributes->add(['error'=>$th]);
}
$controller=$controllerResolver->getController($request);
$arguments=$argumentResolver->getArguments($request,$controller);
call_user_func_array($controller,$arguments);