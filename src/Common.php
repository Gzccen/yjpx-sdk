<?php

namespace Gzcots\Yjpx;

function generateSM3($data){
    $hash = openssl_digest($data, 'sm3');
    return $hash;
}