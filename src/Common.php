<?php

namespace Gzcots\Yjpx;

function generateSM3($data){
    $hash = openssl_digest($data, 'sm3');
    return $hash;
}

function handleMultipart($params = []){
    $multipart = [];
    foreach($params as $key => $value){
        $multipart[] = [
            'name' => $key,
            'contents' => $value,
        ];
    }
    return $multipart;
}