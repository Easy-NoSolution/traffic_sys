<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/09/2017
 * Time: 15:16
 */

require ('connect.php');

$userId = @$_POST['userId'] ? $_POST['userId'] : null;
$password = @$_POST['password'] ? $_POST['password'] : null;
$json = array();
if (empty($userId) && empty($password)) {
    $json = array("result" => "Some value is null");
    exit(json_encode($json));
}

$sql = "select * from user_tb where userId = '{$userId}' and password = '{$password}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if (!$row) {
    $json = array("result" => "This account is not exist or The password is incorrect");
    exit(json_encode($json));
}

$json = array('result' => 'success', 'userInfo' => array('userId' => $row['userId'], 'username' => $row['username'], 'userSex' => $row['userSex'], 'userBirthday' => $row['userBirthday'], 'password' => $row['password']));
exit(json_encode($json));
?>