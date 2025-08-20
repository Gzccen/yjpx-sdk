<?php

namespace Gzcots\Yjpx\Service;

use GuzzleHttp\Client;
use Gzcots\Yjpx\Config\BaseConfig;
use Gzcots\Yjpx\Exception\BadRequestException;
use Psr\Log\LoggerInterface;

use function Gzcots\Yjpx\handleMultipart;

class HttpClient {
    private Client $httpClient;

    protected BaseConfig $baseConfig;

    protected LoggerInterface $logger;

    public function __construct(BaseConfig $baseConfig){
        $this->baseConfig = $baseConfig;
        $this->logger = $baseConfig->logger;
        $this->httpClient = new Client([
            'base_uri' => $baseConfig->baseUri,
            'timeout' => $baseConfig->timeout,
        ]);
    }

    /**
     * 发送GET请求
     */
    public function get($url, $headers = [], $query = []){
        $this->logger->info('get request:', ['url' => $url, 'headers' => $headers, 'query' => $query]);
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
    public function post($url, $headers = [], $params = [], $query = []){
        $this->logger->info('post request:', ['url' => $url, 'headers' => $headers, 'params' => $params, 'query' => $query]);
        $options = [
            'headers' => $headers,
        ];
        if(!empty($params)){
            $options['json'] = $params;
        }
        if(!empty($query)){
            $options['query'] = $query;
        }
        $response = $this->httpClient->post($url, $options);
        $content = $response->getBody()->getContents();
        return $this->handleResponse($content);
    }

    /**
     * 发送文件上传请求
     */
    public function upload($url, $headers = [], $params = []){
        $this->logger->info('upload request:', ['url' => $url, 'headers' => $headers]);
        $response = $this->httpClient->post($url, [
            'headers' => $headers,
            'multipart' => handleMultipart($params),
        ]);
        $content = $response->getBody()->getContents();
        return $this->handleResponse($content);
    }

    function handleResponse($response){
        $this->logger->info('response:', ['response' => $response]);
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