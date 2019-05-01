<?php
require'./redis.php';

$redis = redis_connect::connect();

//获取用户id
$user_id = $_GET['user_id'];

//获取关注的id
$follow_ids = $redis->smembers('user_follow_'.$user_id);

//获取关注者的信息
$data = [];
foreach($follow_ids as $v)
{
    $data[] = $redis->hgetall('user_id_'.$v);
}


// var_dump($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的关注</title>
</head>
<body>
<div><a href="list.php">返回列表页</a></div>
    <table border="1" width="600" style="margin:auto;" >
        <tr>
            <td>id</td>
            <td>姓名</td>
            <td>年龄</td>
        </tr>

        <?php foreach ($data as $key) { ?>
           
            <tr>
                <td><?php echo $key['id'] ?></td>
                <td><?php echo $key['username'] ?></td>
                <td><?php echo $key['age'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>