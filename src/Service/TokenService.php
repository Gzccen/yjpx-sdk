<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Trait\BaseSerivce;
use function Gzcots\Yjpx\generateSM3;

class TokenService{

    use BaseSerivce;

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
        // 暂时设置为3000秒
        $timeOut = 3000;

        $this->cache->set($this->baseConfig->ssoTokenKey, $token, $timeOut);
        return $token;
    }
}