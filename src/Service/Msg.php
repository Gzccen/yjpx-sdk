<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Trait\BaseSerivce;
// 消息通知
class Msg{

    use BaseSerivce;

    /**
     * 消息查询
     * 培训平台查询本平台的监管信息
     */
    public function courseSuperviseListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/course/courseSupervise/listData1', $headers, $params);
        return $response;
    }

    /**
     * 消息推送
     * 培训平台主动推送课程处理结果信息给监管平台
     */
    public function courseSuperviseHandleStatus($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/course/courseSupervise/handleStatus', $headers, $params);
        return $response;
    }
}