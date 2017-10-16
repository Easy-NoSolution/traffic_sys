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

//$sql = "select * from loginLog_tb where userId = '{$userId}' limit '{$offset}', '{$rows}'";
$sql = "select * from loginLog_tb where userId = '{$userId}' limit ".$offset.", ".$rows;
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array("result" => 'failed', 'errorInfo' => "It is failed to search logs", 'sql' => $sql);
    exit(json_encode($json));
}
$json = array('result' => 'success');
exit(json_encode($json));
$json = array('result' => 'success', 'logs' => $result);
exit(json_encode($json));
?>