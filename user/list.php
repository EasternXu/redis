<?php
session_start();
if(!empty($_SESSION['username']))
{
    echo '欢迎登陆！'.$_SESSION['username'];
    echo"<hr>";
}else{
    header('location:login.php');
}

require'./redis.php';
$redis = redis_connect::connect();
//取出全部id

$ids = $redis->lrange('user_list_ids',0,-1);
// var_dump($ids);
//去除哈希表中对应id的数据
$data = [];
foreach($ids as $v)
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
    <title>成员列表</title>
</head>
<body>
    <div><a href="login.php">登录</a>|<a href="register.html">注册</a>|<a href="my_follow.php?id=<?php echo $key['id'] ?>">我的关注</a></div>
    <table border="1" width="600" style="margin:auto;" >
        <tr>
            <td>id</td>
            <td>姓名</td>
            <td>年龄</td>
            <td>操作</td>
        </tr>

        <?php foreach ($data as $key) { ?>
           
            <tr>
                <td><?php echo $key['id'] ?></td>
                <td><?php echo $key['username'] ?></td>
                <td><?php echo $key['age'] ?></td>
                <td>
                    <a href="update.php?id=<?php echo $key['id'] ?>">修改</a> | 
                    <a href="del.php?id=<?php echo $key['id'] ?>">删除</a>
                    <?php if($key['username']!= $_SESSION['username']){ ?>
                        <a href="follow.php?id=<?php echo $key['id'] ?>">关注</a>
                    <?php }?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>