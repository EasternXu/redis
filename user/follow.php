<?php

require'./redis.php';

$redis = redis_connect::connect();


//获取用户id
session_start();
$user_id = $_SESSION['user_id'];
//获取关注者的id
$follow_id = $_GET['id'];

//建立一个集合
$redis->sadd('user_follow_'.$user_id,$follow_id);

header('location:list.php');

?>