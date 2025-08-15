<?php

namespace Gzcots\Yjpx\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Gzcots\Yjpx\Config\BaseConfig;

class HttpClient {
    private Client $httpClient;

    public function __construct(BaseConfig $baseConfig){
        $this->httpClient = new Client([
            'base_uri' => $baseConfig->baseUri,
            'timeout' => $baseConfig->timeout,
        ]);
    }

    public function get($url, $headers = [], $query = []){
        $response = $this->httpClient->get($url, [
            'headers' => $headers,
            'query' => $query,
        ]);
        return $response->getBody()->getContents();
    }


    public function post($url, $headers = [], $params = []){
        $response = $this->httpClient->post($url, [
            'headers' => $headers,
            'json' => $params,
        ]);
        return $response->getBody()->getContents();
    }

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