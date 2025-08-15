<?php

namespace Gzcots\Yjpx;

use GuzzleHttp\Client;

class Token {


    public function getToken($config){
        $client = new Client([
            'base_uri' => $config['base_uri'],
        ]);

        $sign = strtoupper(generateSM3(generateSM3($config['partner-id'] . $config['project-code'] . $config['secret'] . $config['timestamp']).$config['secret']));

        $response = $client->request('POST', $config['uri'], [
            'timestamp' => $config['timestamp'],
            'sign' => $sign,
            'project-code' => $config['project-code'],
            'partner-id' => $config['partner-id'],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}