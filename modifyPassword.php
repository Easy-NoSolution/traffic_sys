<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 27/09/2017
 * Time: 19:50
 */

require ('connect.php');

$userId = @$_POST['userId'] ? $_POST['userId'] : null;
$password = @$_POST['password'] ? $_POST['password'] : null;

$json = array();
if (empty($userId) && empty($password)) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}

$sql = "select userId from user_tb where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if (!$row) {
    $json = array('result' => 'failed', 'errorInfo' => 'This account is not exist');
    exit(json_encode($json));
}

$sql = "update user_tb set password = '{$password}' where userId = '{$userId}'";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to modify password');
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));