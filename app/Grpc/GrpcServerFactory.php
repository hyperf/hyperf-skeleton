<?php
namespace App\Grpc;

use Hyperflex\HttpServer\ServerFactory;

class GrpcServerFactory extends ServerFactory
{
    protected $coreMiddleware = CoreMiddleware::class;
}