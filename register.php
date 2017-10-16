<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/09/2017
 * Time: 15:16
 */

require ('connect.php');
$userId = @$_POST['userId'] ? $_POST['userId'] : null;
$username = @$_POST['username'] ? $_POST['username'] : null;
$userSex = @$_POST['userSex'] ? $_POST['userSex'] : 0;
$userBirthday = @$_POST['userBirthday'] ? $_POST['userBirthday'] : null;
$userBirthday = strtotime($userBirthday);
$password = @$_POST['password'] ? $_POST['password'] : null;
$userAvatar = 'null';
if ($_FILES['userAvatar']['error'] > 0) {
    $json = array('result' => 'failed', 'errorInfo' => $_FILES['userAvatar']['error']);
    exit(json_encode($json));
} else {
//    $userAvatar = addslashes(file_get_contents($_FILES['userAvatar']['tmp_name']));  获取图片数据
    $fillname = $_FILES['userAvatar']['name'];
    $dotArray = explode('.', $fillname);
    $type = end($dotArray);
    $userAvatar = "/traffic_sys_pictures/".$userId.'.'.$type;
    $path = "/usr/local/apache/htdocs".$userAvatar;
//    上传时要去虚拟机下修改文件夹的权限 chmod 777 /usr/local/apache/htdocs/traffic_sys_pictures
//    否则会报错 Error Domain=NSCocoaErrorDomain Code=3840 "JSON text did not start with array or object and option to allow fragments not set." UserInfo={NSDebugDescription=JSON text did not start with array or object and option to allow fragments not set.}
    move_uploaded_file($_FILES['userAvatar']['tmp_name'], $path);
}

if (empty($userId) and empty($username) and empty($userSex) and empty($password)) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}

$sql = "select * from user_tb where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if ($row) {
    $json = array("result" => 'failed', 'errorInfo' => "This account has exist! Please enter another account");
    exit(json_encode($json));
}

$sql = "insert into user_tb (userId, username, userSex, userBirthday, userAvatar, password) values ('{$userId}', '{$username}', '{$userSex}', '{$userBirthday}', '{$userAvatar}', '{$password}')";
if (!mysqli_query($connect, $sql)) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));
?>