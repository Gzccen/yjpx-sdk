<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Request\TokenRequest;
use Psr\SimpleCache\CacheInterface;

use function Gzcots\Yjpx\generateSM3;

class TokenService{

    private CacheInterface $cache;

    public function getToken(BaseConfig $baseConfig){
        $token = $this->cache->get($baseConfig->ssoTokenKey);
        if($token){
            return $token;
        }
        
        $httpClient = new HttpClient($baseConfig);
        $nowTime = time()*1000;
        $str = $baseConfig->partnerId.$baseConfig->projectCode.$baseConfig->secretKey.$nowTime;
        $hash = generateSM3($str);
        $sign = strtoupper(generateSM3($hash.$baseConfig->secretKey));


        $tokenResponse = $httpClient->get('/pxjgDi/v2/getToken', [
            'timestamp' => $nowTime,
            'sign' => $sign,
            'project-code' => $baseConfig->projectCode,
            'partner-id' => $baseConfig->partnerId,
        ]);

        if(!isset($tokenResponse['success']) || !$tokenResponse['success']) {
            throw new \Exception('获取Token失败');
        }

        $token = $tokenResponse['data']['accessToken'];
        $timeOut = $tokenResponse['data']['expiresIn'];

        $this->cache->set($baseConfig->ssoTokenKey, $token, $timeOut);
        return $token;
    }



}