<?php

namespace Gzcots\Yjpx\Trait;

use Gzcots\Yjpx\Config\BaseConfig;
use Psr\SimpleCache\CacheInterface;

trait BaseSerivce{
    protected CacheInterface $cache;
    protected BaseConfig $baseConfig;

    public function __construct(CacheInterface $cache, BaseConfig $baseConfig){
        $this->cache = $cache;
        $this->baseConfig = $baseConfig;
    }
}