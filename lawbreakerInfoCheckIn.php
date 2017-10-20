<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/10/2017
 * Time: 17:41
 */

require ("connect.php");

$carId = @$_POST['carId'] ? $_POST['carId'] : null;
$carOwnerId = @$_POST['carOwnerId'] ? $_POST['carOwnerId'] : null;
$lawbreakerInfo = @$_POST['lawbreakerInfo'] ? $_POST['lawbreakerInfo'] : null;

$json = array();
if (empty($carId) or empty($carOwnerId) or empty($lawbreakerInfo)) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}
$json = array('result' => 'failed', 'errorInfo' => 'It is failed to insert data to database!', 'sql' => 'kkdf');
exit(json_encode($json));
$sql = "insert into lawbreakerInfo_tb (carId, carOwnerId, lawbreakerInfo) VALUES ('{$carId}', '{$carOwnerId}', '{$lawbreakerInfo}')";

if (!mysqli_query($connect, $sql)) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));
?>