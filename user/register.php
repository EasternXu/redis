<?php
require'./redis.php';
$redis = redis_connect::connect();

$username = $_POST['username'];
$pwd = $_POST['pwd'];
$age = $_POST['age'];




$id = $redis->incr('user_id');
$redis->hmset('user_id_'.$id,['id'=>$id,'username'=>$username,'pwd'=>$pwd,'age'=>$age]);
$redis->lpush('user_list_ids',$id);
$redis->set($username.'_login',$id);
header('location:login.php');

