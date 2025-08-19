<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Trait\BaseSerivce;
use function Gzcots\Yjpx\filterByKeys;

class TrainPlatformOrg{
    use BaseSerivce;
    /**
     * 备案效验
     * 机构在多个地市开展培训业务时会在每个地市进行备案，每个地市都有唯一的机构ID，接口会返回行政区域编码及对应的机构唯一ID集合。
     * 业务数据发生在哪个地市就用对应的机构唯一ID
     */
    public function verify($params = []){
        $headers = $this->baseConfig->getHeaders();
        $httpClient = new HttpClient($this->baseConfig);
        $query = filterByKeys($params, ['type', 'idType', 'idNo']);
        $json = [];
        $data = $httpClient->post('/pxjgDi/org/orgBase/verify', $headers, $json, $query);
        return $data;
    }

    /**
     * 机构入驻接口
     */
    public function save($params = []){
        $headers = $this->baseConfig->getHeaders();
        $httpClient = new HttpClient($this->baseConfig);
        $query = filterByKeys($params, ['orgUid', 'status', 'createDate']);
        $json = [];
        $data = $httpClient->post('/pxjgDi/train/trainPlatformOrg/save', $headers, $json, $query);
        return $data;
    }
}