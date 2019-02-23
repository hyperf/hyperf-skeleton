<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.org
 * @document https://wiki.hyperf.org
 * @contact  group@hyperf.org
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controllers;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Tracer\Annotation\Trace;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController
 * @Trace
 */
class TracingController
{
    /**
     * @Inject
     * @var \Hyperf\Tracer\Tracing
     */
    private $tracing;

    /**
     * @Inject
     * @var ClientFactory
     */
    private $clientFactory;

    public function index()
    {
        $span1 = $this->tracing->span('open.tracing');
        $span1->start();
        $span2 = $this->tracing->span('open.tracing.2');
        $span2->start();
        $response = 'Hello Open-Tracing.';
        $span2->tag('response', $response);
        $span2->finish();
        $span1->tag('response', $response);
        $span1->finish();
        return $response;
    }

    public function sendRequest()
    {
        $client = $this->clientFactory->create();
        $response = $client->get('http://127.0.0.1:9501/tracing/index');
        return $response->getBody()->getContents();
    }

    /**
     * @Trace
     */
    public function annotation()
    {
        return 'Hello Open-Tracing.';
    }
}
