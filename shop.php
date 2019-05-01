<?php

class shop{

    // public $redis=null;

    public function connect()
    {
        //链接
        $redis = new Redis();

        $redis->connect('127.0.0.1');

        $redis->auth('123456');
        return $redis;
    }

    public function add($redis)
    {
        //添加库存
        for($i=0;$i<100;$i++)
        {
            $redis->lpush('goods_stord',$i);
        }

        return ok;
    }

    public function settime($redis)
    {
       return $redis->setTimeout('goods_stord',60);
    }
    public function get($redis)
    {
        //开始抢购
        $id = $redis->lpop('goods_stord');
        if(!$id)
        {
            echo"抢购失败";
        }else{
            echo"抢购成功".$id;
        }
    }


}


$shop = new shop();
$redis = $shop->connect();

// echo($shop->add($redis));
// echo($shop->settime($redis));
$shop->get($redis);

?>