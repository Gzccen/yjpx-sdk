<?php

namespace Gzcots\Yjpx;

use Psr\SimpleCache\CacheInterface;

class Client{
    
    private string $partnerId;
    private string $projectCode;

    private CacheInterface $cache;

    public function __construct($config) {
        $this->partnerId = $config['partnerId'];
        $this->projectCode = $config['projectCode'];
        $this->cache = $config['cache'];
    }



}