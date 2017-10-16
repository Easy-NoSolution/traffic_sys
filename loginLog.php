<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 16/10/2017
 * Time: 11:42
 */
require ("connect.php");

$userId = @$_POST['userId'] ? $_POST['userId'] : null;
$loginDate = @$_POST['loginDate'] ? $_POST['loginDate'] : null;
$logoutDate = @$_POST['logoutDate'] ? $_POST['logoutDate'] : null;
$loginDate = strtotime($loginDate);
$logoutDate = strtotime($logoutDate);

$json = array();
$json = array('1' => empty($userId), '2' => empty($loginDate), '3' => empty($logoutDate));
exit(json_encode($json));
if (empty($userId) && (empty($loginDate) || empty($logoutDate))) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}

$sql = "insert into loginLog_tb ('userId', 'loginDate', logoutDate) VALUES ('{$userId}', '{$loginDate}', '{$logoutDate}')";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));

?>