<?php

namespace Swoft\Http\Message\Bean\Parser;

use Swoft\Bean\Parser\AbstractParser;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use Swoft\Http\Message\Bean\Collector\MiddlewareCollector;

/**
 * Middleware parser
 */
class MiddlewareParser extends AbstractParser
{

    /**
     * Parse middleware annotation
     *
     * @param string      $className
     * @param Middleware  $objectAnnotation
     * @param string      $propertyName
     * @param string      $methodName
     * @param string|null $propertyValue
     *
     * @return mixed
     */
    public function parser(
        string $className,
        $objectAnnotation = null,
        string $propertyName = '',
        string $methodName = '',
        $propertyValue = null
    ) {
        MiddlewareCollector::collect($className, $objectAnnotation, $propertyName, $methodName, $propertyValue);
        return null;
    }
}
