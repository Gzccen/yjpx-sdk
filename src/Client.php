<?php

namespace Gzcots\Yjpx;

use Gzcots\Yjpx\Request\TokenRequest;

class Client{

    private string $projectCode;
    private string $partnerId;

    public function __construct($projectCode, $partnerId) {
        $this->projectCode = $projectCode;
        $this->partnerId = $partnerId;
    }

}