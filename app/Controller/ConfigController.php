<?php

namespace App\Controller;

use Hyperf\ConfigApollo\ClientInterface;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class ConfigController
{
    /**
     * @Inject()
     * @var ConfigInterface
     */
    private $config;

    /**
     * @Inject()
     * @var ClientInterface
     */
    private $apollo;

    /**
     * @Inject()
     * @var \Hyperf\ConfigAliyunAcm\ClientInterface
     */
    private $aliyunAcm;

    public function get()
    {
        return $this->config->get('config-center', 'test');
    }

    public function apolloPull()
    {
        $this->apollo->pull(['application', 'test-namespace']);
        return $this->config->get('config-center', 'test');
    }

    public function aliyunAcmPull()
    {
        return $this->aliyunAcm->pull();
    }

}