<?php

namespace Gzcots\Yjpx\Config;

/**
 * 基础配置
 * @property string $partnerId partnerId
 * @property string $projectCode projectCode
 * @property string $baseUri URL
 * @property int $timeout 超时时间
 * @property string $ssoTokenKey SSO令牌缓存键
 * @property string $secretKey privateKey密钥
 */
class BaseConfig{


    protected string $partnerId;
    protected string $projectCode;
    protected string $baseUri = 'https://yss-gd.i-aq.cn';
    protected int $timeout = 30;
    protected string $ssoTokenKey = 'ssoToken';
    protected string $secretKey;

    public function __construct($partnerId, $projectCode, $secretKey){
        $this->partnerId = $partnerId;
        $this->projectCode = $projectCode;
        $this->secretKey = $secretKey;
    }
    public function __get($name){
        return $this->$name;
    }
    public function __set($name, $value){
        $this->$name = $value;
    }
}