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

/**
 * 根据keys生成新数组
 */
function filterByKeys($array = [], $keys = []) {
    $newData = array_intersect_key($array, array_flip($keys));
    return $newData;
}