<?php

namespace Gzcots\Yjpx;

use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Request\BaseRequest;
use Psr\SimpleCache\CacheInterface;

class Client{
    private CacheInterface $cache;

    private BaseConfig $baseConfig;

    public function __construct($config) {
        $this->baseConfig = new BaseConfig($config['partnerId'], $config['projectCode'], $config['secretKey']);
        $this->cache = $config['cache'];
    }

    public function getToken(){

        
    }



}