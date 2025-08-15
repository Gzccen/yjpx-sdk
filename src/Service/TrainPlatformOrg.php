<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Config\BaseConfig;
use Psr\SimpleCache\CacheInterface;

class TrainPlatformOrg{
    private CacheInterface $cache;
    private BaseConfig $baseConfig;

    public function __construct(CacheInterface $cache, BaseConfig $baseConfig){
        $this->cache = $cache;
        $this->baseConfig = $baseConfig;
    }

    /**
     * 备案效验
     */
    public function verify($params = []){
        $headers = $this->baseConfig->getHeaders();
        $httpClient = new HttpClient($this->baseConfig);
        $data = $httpClient->post('/pxjgDi/org/orgBase/verify', $headers, $params);
        return $data;
    }

    /**
     * 机构入驻接口
     */
    public function save($params = []){
        $headers = $this->baseConfig->getHeaders();
        $httpClient = new HttpClient($this->baseConfig);
        $data = $httpClient->post('/pxjgDi/train/trainPlatformOrg/save', $headers, $params);
        return $data;
    }




}