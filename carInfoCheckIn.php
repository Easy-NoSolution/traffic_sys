<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/10/2017
 * Time: 17:41
 */

require ("connect.php");

$carId = @$_POST['carId'] ? $_POST['carId'] : null;
$carName = @$_POST['carName'] ? $_POST['carName'] : null;
$carColor = @$_POST['carColor'] ? $_POST['carColor'] : null;
$carOwnerId = @$_POST['carOwnerId'] ? $_POST['carOwnerId'] : null;

$json = array();

if (empty($carId) and empty($carName) and empty($carColor) and empty($carOwnerId)) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}

$sql = "select * from car_tb where carId = '{$carId}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if ($row) {
    $json = array("result" => 'failed', 'errorInfo' => "This account has exist! Please enter another account", 'sql' => $sql);
    exit(json_encode($json));
}

$sql = "insert into car_tb (carId, carName, carColor, carOwnerId) values ('{$carId}', '{$carName}', '{$carColor}', '{$carOwnerId}')";
if (!mysqli_query($connect, $sql)) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));
?>