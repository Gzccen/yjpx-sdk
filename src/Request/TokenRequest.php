<?php

namespace Gzcots\Yjpx\Request;

use Gzcots\Yjpx\Exception\BadRequestException;

class TokenRequest {

    public string $timestamp;

    public array $requiredFields = [
        'timestamp',
    ];

    public function __construct($config){
        foreach ($this->requiredFields as $field) {
            if (!isset($config[$field])) {
                throw new BadRequestException($field."不能为空!");
            }
            $this->$field = $config[$field];
        }
    }
}