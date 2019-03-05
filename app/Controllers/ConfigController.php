<?php

namespace App\Controllers;

use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class ConfigController
{

    /**
     * @\Hyperf\Di\Annotation\Inject()
     * @var \Hyperf\ConfigApollo\ClientInterface
     */
    private $client;

    /**
     * @\Hyperf\Di\Annotation\Inject()
     * @var \Hyperf\Contract\ConfigInterface
     */
    private $config;

    public function pull()
    {
         $this->client->pull(['application', 'test-namespace']);
         return $this->config->get('config-center');
    }

    public function get()
    {
        return $this->config->get('config-center');
    }

}