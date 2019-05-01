<?php

require'./redis.php';
$redis = redis_connect::connect();

$data=[];
if( isset($_GET['id'])){
    $id = $_GET['id'];
    //取出被修改的数据

    $data = $redis->hgetall('user_id_'.$id);
}
if(isset($_POST['username'])){

    //删除原先姓名的登录id
    $redis->delete($data['username'].'_login');

    
    $id = $_POST['id'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $age = $_POST['age'];
    //修改原先的登录缓存
    session_start();
    $_SESSION['username'] = $username;
    //设置新的登录id
    $redis->set($username.'_login',$id);
    $redis->hmset('user_id_'.$id,['id'=>$id,'username'=>$username,'pwd'=>$pwd,'age'=>$age]);
    header('location:list.php');
}



var_dump($data);

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
    <form action="update.php" method="post">
        id：<input  type="text" name="id" id="" readonly value="<?php echo $data['id'] ?>"><br>
        用户名：<input  type="text" name="username" id="" value="<?php echo $data['username'] ?>"><br>
        密  码：<input type="text" name="pwd" id="" value="<?php echo $data['pwd'] ?>"><br>
        年  龄：<input type="text" name="age" id="" value="<?php echo $data['age'] ?>"><br>
        <input type="submit" value="提交">
    </form>
</body>
</html>