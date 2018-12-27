<?php
namespace App\HttpServer;

use Hyperf\HttpServer\ServerFactory;

class HttpServerFactory extends ServerFactory
{
    protected $coreMiddleware = CoreMiddleware::class;
}
