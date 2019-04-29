<?php

$redis = new Redis();

$redis->connect('127.0.0.1');
//密码设置
$redis->auth('123456');

//string
$redis->set('username','libai');


//hash
$redis->hMset('user',['name'=>'lxd','age'=>'23','sex'=>'男']);

//list
$redis->lPush('user-list','李白');

$redis->lPush('user-list','杜甫');
$redis->lPush('user-list','杜牧');


echo  $redis->keys(['*']);