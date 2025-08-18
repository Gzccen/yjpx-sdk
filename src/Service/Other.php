<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Trait\BaseSerivce;

// 其他
class Other{
    
    use BaseSerivce;

    /**
     * 文件上传接口
     */
    public function fileUpload($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->upload('/pxjgDi/sys/utils/file/upload', $headers, $params);
        return $response;
    }

    /**
     * 行政区划接口
     */
    public function sysAreaListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/sys/utils/sysArea/listData', $headers, $params);
        return $response;
    }

    /**
     * 数据字典接口
     */
    public function dictDataListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/sys/utils/dictData/listData', $headers, $params);
        return $response;
    }


}