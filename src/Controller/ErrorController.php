<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class ErrorController {
    public function error404(Request $request){
        var_dump('404');
    }
    public function error500(Request $request){
        var_dump('500');
    }
}