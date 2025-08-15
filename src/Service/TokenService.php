<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Exception\BadRequestException;
use Psr\SimpleCache\CacheInterface;

use function Gzcots\Yjpx\generateSM3;

class TokenService{

    private CacheInterface $cache;
    private BaseConfig $baseConfig;

    public function __construct(CacheInterface $cache, BaseConfig $baseConfig){
        $this->cache = $cache;
        $this->baseConfig = $baseConfig;
    }

    /**
     * 调用《授权->获取token-V2》接口获取token
     */
    public function getToken(){
        $token = $this->cache->get($this->baseConfig->ssoTokenKey);
        if($token){
            return $token;
        }

        $httpClient = new HttpClient($this->baseConfig);
        $nowTime = time()*1000;
        $str = $this->baseConfig->partnerId.$this->baseConfig->projectCode.$this->baseConfig->secretKey.$nowTime;
        $hash = generateSM3($str);
        $sign = strtoupper(generateSM3($hash.$this->baseConfig->secretKey));

        $tokenResponse = $httpClient->post('/pxjgDi/v2/getToken', [
            'timestamp' => $nowTime,
            'sign' => $sign,
            'project-code' => $this->baseConfig->projectCode,
            'partner-id' => $this->baseConfig->partnerId,
        ]);

        $token = $tokenResponse['accessToken'];
        $timeOut = $tokenResponse['expiresIn'];
        // 预留1分钟
        $timeOut -= 60;

        $this->cache->set($this->baseConfig->ssoTokenKey, $token, $timeOut);
        return $token;
    }



}