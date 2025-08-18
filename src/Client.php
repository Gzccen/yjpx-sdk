<?php

namespace Gzcots\Yjpx;

use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Service\Course;
use Gzcots\Yjpx\Service\Msg;
use Gzcots\Yjpx\Service\Other;
use Gzcots\Yjpx\Service\Student;
use Gzcots\Yjpx\Service\TokenService;
use Gzcots\Yjpx\Service\TrainPlatformOrg;
use Psr\SimpleCache\CacheInterface;

class Client{
    const PROD_BASE_URI = 'https://pxjg-gd.i-aq.cn';
    const DEV_BASE_URI = 'https://yss-gd.i-aq.cn';
    private CacheInterface $cache;
    private BaseConfig $baseConfig;

    public function __construct($config) {
        $this->baseConfig = new BaseConfig($config['partnerId'], $config['projectCode'], $config['secretKey']);
        $this->cache = $config['cache'];
        // 初始化tokenService
        $this->baseConfig->tokenService = new TokenService($this->cache, $this->baseConfig);
        // 判断环境
        if(isset($config['debug']) && $config['debug']){
            $this->baseConfig->baseUri = self::DEV_BASE_URI;
        } else {
            $this->baseConfig->baseUri = self::PROD_BASE_URI;
        }
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

    /**
     * 获取课程service
     * @return Course
     */
    public function getCourse():Course{
        $courseService = new Course($this->cache, $this->baseConfig);
        return $courseService;
    }

    /**
     * 获取学员档案service
     * @return Student
     */
    public function getStudent():Student{
        $studentService = new Student($this->cache, $this->baseConfig);
        return $studentService;
    }

    /**
     * 获取消息通知service
     * @return Msg
     */
    public function getMsg():Msg{
        $msgService = new Msg($this->cache, $this->baseConfig);
        return $msgService;
    }

    /**
     * 获取其他service
     * @return Other
     */
    public function getOther(){
        $otherService = new Other($this->cache, $this->baseConfig);
        return $otherService;
    }
}