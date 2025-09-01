<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Trait\BaseSerivce;

use function Gzcots\Yjpx\filterByKeys;

// 其他
class Other{
    
    use BaseSerivce;

    /**
     * 文件上传接口
     */
    public function fileUpload($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->upload('/pxjgDi/sys/utils/fileUpload', $headers, $params);
        return $response;
    }

    /**
     * 行政区划接口
     */
    public function sysAreaListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = filterByKeys($params, ['pageNo', 'pageSize', 'updateDateGteStr']);
        $json = [];
        $response = $httpClient->post('/pxjgDi/sys/utils/sysArea/listData', $headers, $json, $query);
        return $response;
    }

    /**
     * 数据字典接口
     */
    public function dictDataListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = filterByKeys($params, ['pageNo', 'pageSize', 'dictType', 'updateDateGteStr']);
        $json = [];
        $response = $httpClient->post('/pxjgDi/sys/utils/dictData/listData', $headers, $json, $query);
        return $response;
    }

    /**
     * 培训平台信息修改
     */
    public function trainPlatformSave($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = filterByKeys($params, ['platformName', 'platformShortName', 'platformUrl', 'trainPlatformThumbnail']);
        $json = [];
        $response = $httpClient->post('/pxjgDi/train/trainPlatform/save', $headers, $json, $query);
        return $response;
    }
}