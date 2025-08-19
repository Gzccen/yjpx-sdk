<?php

namespace Gzcots\Yjpx\Service;

use Gzcots\Yjpx\Trait\BaseSerivce;

use function Gzcots\Yjpx\filterByKeys;

// 学员档案
class Student{

    use BaseSerivce;

    /**
     * 学员信息同步
     */
    public function saveStudent($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = [];
        $json = filterByKeys($params, [
            'personId', 'pxptSrcId', 'name', 'certType', 'certNo', 'sex', 'phoneNumber', 'education', 'email', 'startWorkDate', 'homeAddress', 'jobTitle', 'inductionTime', 'entName', 'entCertNo', 'dataMap'
        ]);
        $response = $httpClient->post('/pxjgDi/person/personInfo/saveStudent', $headers, $json, $query);
        return $response;
    }

    /**
     * 学习记录批量同步-V2
     * 1、本接口请求成功，不代表学习记录入库成功，需要调用《学习记录批量同步结果查询》接口查询查询入库失败数据（建议10分钟后调用），并对失败数据按照要求修正后，重新同步。
     * 2、一批最多100条数据。
     */
    public function studentStudyRecordSyncDataBatchSync($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $query = [];
        $json = filterByKeys($params, ['recordList']);
        $headers = $this->baseConfig->getHeaders();
        $response = $httpClient->post('/pxjgDi/student/studentStudyRecordSyncData/v2/batchSync', $headers, $json, $query);
        return $response;
    }

    /**
     * 学时记录-V2
     * 先同步学习记录，再同步学时记录时，使用此接口。
     * 1、课程ID修改为课程类目编码
     */
    public function studentPeriodRecordSaveData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = [];
        $json = filterByKeys($params, ['pxptSrcId', 'personId', 'orgUid', 'categoryCode', 'startDate', 'endDate', 'validTime', 'ipAddress', 'recordIds']);
        $response = $httpClient->post('/pxjgDi/student/studentPeriodRecord/v2/saveData', $headers, $json, $query);
        return $response;
    }

    /**
     * 学习记录批量同步结果查询
     * 结果记录数据只保留1个月，超出时间的记录将被删除。
     * 1、增加按批次号查询
     * 2、增加按时间段查询，按时间段查询时开始时间、结束时间都不能为空
     * 3、批次号、同步时间、时间段查询，三选一必填
     */
    public function studentStudyRecordSyncDataSyncResult($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = filterByKeys($params, ['ssrsdId', 'syncTime', 'startTime', 'endTime', 'handleResult', 'pageNo', 'pageSize']);
        $json = [];
        $response = $httpClient->post('/pxjgDi/student/studentStudyRecordSyncData/syncResult', $headers, $json, $query);
        return $response;
    }

    /**
     * 学习过程人脸照片
     * 1、pictureTime-截图时间，改为必填
     */
    public function studentStudyPictureSaveData($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = [];
        $json = filterByKeys($params, ['recordId', 'studentStudyPictureList']);
        $response = $httpClient->post('/pxjgDi/student/studentStudyPicture/saveData', $headers, $json, $query);
        return $response;
    }

    /**
     * 学习证明
     */
    public function personCertSave($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = [];
        $json = filterByKeys($params, ['pxptSrcId', 'personId', 'orgUid', 'subjectCode', 'startDate', 'endDate', 'dataMap']);
        $response = $httpClient->post('/pxjgDi/person/personCert/save', $headers, $json, $query);
        return $response;
    }

    /**
     * 学时记录作废
     */
    public function studentPeriodRecordNullify($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = filterByKeys($params, ['pxptSrcIds']);
        $json = [];
        $response = $httpClient->post('/pxjgDi/student/studentPeriodRecord/nullify', $headers, $json, $query);
        return $response;
    }

    /**
     * 学习记录作废
     */
    public function studentStudyRecordNullify($params = []){
        $httpClient = new HttpClient($this->baseConfig);
        $headers = $this->baseConfig->getHeaders();
        $query = filterByKeys($params, ['pxptSrcIds']);
        $json = [];
        $response = $httpClient->post('/pxjgDi/student/studentStudyRecord/nullify', $headers, $json, $query);
        return $response;
    }
}