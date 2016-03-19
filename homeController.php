<?php

namespace jra;

use Psr\Http\Message\ServerRequestInterface as SRI;
use Psr\Http\Message\ResponseInterface as RI;

class HomeController
{
    public function dispatch(SRI $request, RI $response, array $args)
    {

        echo 'hello';
    }
}

