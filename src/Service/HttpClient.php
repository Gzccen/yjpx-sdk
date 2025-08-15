<?php

namespace Gzcots\Yjpx\Service;

use GuzzleHttp\Client;
use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Exception\BadRequestException;

class HttpClient {
    private Client $httpClient;

    public function __construct(BaseConfig $baseConfig){
        $this->httpClient = new Client([
            'base_uri' => $baseConfig->baseUri,
            'timeout' => $baseConfig->timeout,
        ]);
    }

    /**
     * 发送GET请求
     */
    public function get($url, $headers = [], $query = []){
        $response = $this->httpClient->get($url, [
            'headers' => $headers,
            'query' => $query,
        ]);
        $content = $response->getBody()->getContents();
        return $this->handleResponse($content);
    }

    /**
     * 发送POST请求
     */
    public function post($url, $headers = [], $params = []){
        $response = $this->httpClient->post($url, [
            'headers' => $headers,
            'json' => $params,
        ]);
        $content = $response->getBody()->getContents();
        return $this->handleResponse($content);
    }

    function handleResponse($response){
        $responseData = json_decode($response, true);
        if(!isset($responseData['success']) || !$responseData['success']){
            throw new BadRequestException($responseData['message'] ?? '请求失败');
        }
        return $responseData['data'] ?? [];
    }

    /**
     * 创建HTTP客户端
     */
    public function getClient($baseUri = null, $timeout = 30){
        if($baseUri){
            return new Client([
                'base_uri' => $baseUri,
                'timeout' => $timeout,
            ]);
        }
        return $this->httpClient;
    }

}