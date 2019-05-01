<?php

require'./redis.php';

$redis = redis_connect::connect();

$id = $_GET['id'];
//删除哈希表中的数据
$redis->delete('user_id_'.$id);

//删除链中的id
$redis->lrem('user_list_ids',$id,0);

header('location:list.php');

?>