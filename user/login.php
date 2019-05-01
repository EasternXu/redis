<?php

require'./redis.php';

$redis = redis_connect::connect();

$username = $_POST['username'];
$pwd = $_POST['pwd'];

$id = $redis->get($username.'_login');

$dbpwd = $redis->hget('user_id_'.$id,'pwd');

if (!empty($username) && $pwd == $dbpwd) {
    echo'登录成功';
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['pwd'] = $pwd;
    $_SESSION['user_id'] = $id;
    header('location:list.php');

}else{
    echo'登录失败';
    // header('licaltion:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
    
</head>
<body>
    <form action="" method="post">
        用户名：<input  type="text" name="username" id=""><br>
        密  码：<input type="text" name="pwd" id=""><br>
        <input type="submit" value="提交">
    </form>
</body>
</html>