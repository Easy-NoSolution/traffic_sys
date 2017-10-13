<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 09/10/2017
 * Time: 14:05
 */

require ("connect.php");
$userId = @$_POST['userId'] ? $_POST['userId'] : null;
$username = @$_POST["username"] ? $_POST["username"] : null;
$userSex = @$_POST['userSex'] ? $_POST['userSex'] : null;
$userBirthday = @$_POST['userBirthday'] ? $_POST['userBirthday'] : null;
$userBirthday = strtotime($userBirthday);
$userAvatar = null;
$json = array();

if ($_FILES['userAvatar']['error'] > 0) {
    $json = array('result' => 'failed', 'errorInfo' => $_FILES['userAvatar']['error']);
    exit(json_encode($json));
} else {
    $fillname = $_FILES['userAvatar']['name'];
    $dotArray = explode('.', $fillname);
    $type = end($dotArray);
    $userAvatar = "/traffic_sys_pictures/".$userId.'.'.$type;
    $path = "/usr/local/apache/htdocs".$userAvatar;
    move_uploaded_file($_FILES['userAvatar']['tmp_name'], $path);
}
if (empty($username) and empty($userSex)) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}

$sql = "update user_tb set username = '{$username}' where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to modify username');
    exit(json_encode($json));
}
$json = array('username1' => $_POST['username'], 'username2' => $username);
exit(json_encode($json));
$sql = "update user_tb set userSex = '{$userSex}' where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to modify userSex');
    exit(json_encode($json));
}
$sql = "update user_tb set userBirthday = '{$userBirthday}' where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to modify userBirthday');
    exit(json_encode($json));
}
$sql = "update user_tb set userAvatar = '{$userAvatar}' where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to modify userAvatar');
    exit(json_encode($json));
}

$sql = "select * from user_tb where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if (!$row) {
    $json = array("result" => 'failed', 'errorInfo' => "This account is not exist");
    exit(json_encode($json));
}

$json = array('result' => 'success', 'userInfo' => array('userId' => $row['userId'], 'username' => $row['username'], 'userSex' => $row['userSex'], 'userBirthday' => $row['userBirthday'], 'userAvatar' => $row['userAvatar'], 'password' => $row['password']));
exit(json_encode($json));
?>

