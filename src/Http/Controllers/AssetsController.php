<?php

namespace Sandbox\Webpack\Http\Controllers;

use Illuminate\Routing\Controller as Controller;

class AssetsController extends Controller
{

    public function js()
    {
        $response = response(file_get_contents(realpath(__DIR__.'/../../assets/webpack.js')));

        $response->headers->add([
            'Content-Type' => 'text/javascript; charset=utf-8'
        ]);

        return $response;
    }

    public function css()
    {
        $response = response(file_get_contents(realpath(__DIR__.'/../../assets/webpack.css')));

        $response->headers->add([
            'Content-Type' => 'text/css; charset=UTF-8'
        ]);

        return $response;
    }
}