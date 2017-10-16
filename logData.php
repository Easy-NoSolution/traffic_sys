<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 16/10/2017
 * Time: 11:42
 */
require ("connect.php");

$userId = @$_GET['userId'] ? $_GET['userId'] : null;
$offset = @$_GET['offset'] ? $_GET['offset'] : 0;
$rows = $_GET['rows'] ? $_GET['rows'] : 0;

if (empty($userId)) {
    $json = array('result' => 'failed', 'errorInfo' => 'UserId is null');
    exit(json_encode($json));
}

$sql = "select * from loginLog_tb where userId = '{$userId}' order by loginId desc limit {$offset}, {$rows}";
$result = mysqli_query($connect, $sql);
$logs = array();
while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    array_push($logs, array('loginDate' => $row['loginDate'], 'logoutDate' => $row['logoutDate']));
}
$json = array('result' => 'success', 'logs' => $logs);
exit(json_encode($json));
?>