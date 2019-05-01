<?php
// namespace user\redis;

class redis_connect{

    // public $redis=null;

    public static function connect()
    {
        //链接
        $redis = new Redis();

        $redis->connect('127.0.0.1');

        $redis->auth('123456');
        return $redis;
    }
}

?>