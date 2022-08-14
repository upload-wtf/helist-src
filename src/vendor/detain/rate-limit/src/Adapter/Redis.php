<?php

namespace Detain\RateLimit\Adapter;

/**
 * @author Peter Chung <touhonoob@gmail.com>
 * @date May 16, 2015
 */
class Redis extends \Detain\RateLimit\Adapter
{

    /**
     * @var \Redis
     */
    protected $redis;

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param string $key
     * @param float|mixed $value
     * @param int $ttl
     * @return bool
     */
    public function set($key, $value, $ttl)
    {
        return $this->redis->set($key, (string)$value, $ttl);
    }

    /**
     * @return float|mixed
     * @param string $key
     */
    public function get($key)
    {
        return (float)$this->redis->get($key);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return $this->redis->exists($key) == true;
    }

    /**
     * @param string $key
     * @return  bool
     */
    public function del($key)
    {
        return $this->redis->del($key) > 0;
    }
}
