<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 16/10/2017
 * Time: 11:42
 */
require ("connect.php");

$userId = @$_POST['userId'] ? $_POST['userId'] : null;
$offset = @$_POST['offset'] ? $_POST['offset'] : 0;
$rows = $_POST['rows'] ? $_POST['rows'] : 0;

if (empty($userId)) {
    $json = array('result' => 'failed', 'errorInfo' => 'UserId is null');
    exit(json_encode($json));
}

$sql = "select * form loginLog_tb where userId = '{$userId}' limit '{$offset}', '{$rows}'";
$result = mysqli_query($connect, $sql);
if (!$result) {
    $json = array("result" => 'failed', 'errorInfo' => "It is failed to search logs");
    exit(json_encode($json));
}
$json = array('result' => 'success', 'logs' => $result);
exit(json_encode($json))
?>