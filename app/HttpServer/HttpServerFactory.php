<?php
namespace App\HttpServer;

use Hyperflex\HttpServer\ServerFactory;

class HttpServerFactory extends ServerFactory
{
    protected $coreMiddleware = CoreMiddleware::class;
}