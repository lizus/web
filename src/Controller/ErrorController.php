<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class ErrorController {
    public function error404(Request $request){
        var_dump($request->attributes->get('error'));
    }
    public function error500(Request $request){
        var_dump($request->attributes->get('error'));
    }
}