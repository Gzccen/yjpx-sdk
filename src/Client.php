<?php

namespace Gzcots\Yjpx;

use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Service\TokenService;
use Psr\SimpleCache\CacheInterface;

class Client{
    private CacheInterface $cache;

    private BaseConfig $baseConfig;

    public function __construct($config) {
        $this->baseConfig = new BaseConfig($config['partnerId'], $config['projectCode'], $config['secretKey']);
        $this->cache = $config['cache'];
    }

    /**
     * 获取接口调用header的ssotoken
     */
    public function getToken(){
        $tokenService = new TokenService($this->cache, $this->baseConfig);
        return $tokenService->getToken();
    }



}