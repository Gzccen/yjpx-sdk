<?php

namespace Gzcots\Yjpx;

use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Service\TokenService;
use Gzcots\Yjpx\Service\TrainPlatformOrg;
use Psr\SimpleCache\CacheInterface;

class Client{
    private CacheInterface $cache;

    private BaseConfig $baseConfig;

    public function __construct($config) {
        $this->baseConfig = new BaseConfig($config['partnerId'], $config['projectCode'], $config['secretKey']);
        $this->cache = $config['cache'];
        // 初始化tokenService
        $this->baseConfig->tokenService = new TokenService($this->cache, $this->baseConfig);
    }

    /**
     * 获取接口调用header的ssotoken
     */
    public function getToken(){
        $tokenService = $this->baseConfig->tokenService;
        return $tokenService->getToken();
    }
    /**
     * 获取机构库service
     * @return TrainPlatformOrg
     */
    public function getTrainPlatformOrg():TrainPlatformOrg{
        $trainPlatformOrgService = new TrainPlatformOrg($this->cache, $this->baseConfig);
        return $trainPlatformOrgService;
    }



}