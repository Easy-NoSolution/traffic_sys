<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 16/10/2017
 * Time: 11:42
 */
require ("connect.php");

$userId = @$_GET['userId'] ? $_GET['userId'] : null;
$loginDate = @$_GET['loginDate'] ? $_GET['loginDate'] : null;
$logoutDate = @$_GET['logoutDate'] ? $_GET['logoutDate'] : null;
$loginDate = strtotime($loginDate);
$logoutDate = strtotime($logoutDate);

$json = array();
if (empty($userId) and (empty($loginDate) or empty($logoutDate))) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}

$sql = "insert into loginLog_tb ('userId', 'loginDate', 'logoutDate') VALUES ('{$userId}', '{$loginDate}', '{$logoutDate}')";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));

?>