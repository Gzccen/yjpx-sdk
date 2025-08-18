<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Trait\BaseSerivce;

// 课程管理
class Course{
    
    use BaseSerivce;
    
    /**
     * 科目查询
     */
    public function courseSubjectListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/course/courseSubject/listData1', $headers, $params);
        return $response;
    }

    /**
     * 科目学时
     */
    public function courseSubjectHourListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/course/courseSubjectHour/listData1', $headers, $params);
        return $response;
    }

    /**
     * 课程类目查询
     */
    public function courseCategoryListData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/course/courseCategory/listData1', $headers, $params);
        return $response;
    }

    /**
     * 课程同步
     */
    public function courseDetailSave($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/course/courseDetail/save', $headers, $params);
        return $response;
    }

    /**
     * 课程与机构关系
     */
    public function courseDetailOrgSave($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/course/courseDetailOrg/save', $headers, $params);
        return $response;
    }
}