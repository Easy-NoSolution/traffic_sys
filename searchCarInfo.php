<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/10/2017
 * Time: 17:42
 */

require ('connect.php');

$carId = @$_GET['carId'] ? $_GET['carId'] : null;

if (empty($carId)) {
    $json = array('result' => 'failed', 'errorInfo' => 'carId is null');
    exit(json_encode($json));
}

$sql = "select * from car_tb where carId = '{$carId}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if (!$row) {
    $json = array("result" => 'failed', 'errorInfo' => "This carId is not exist", 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success', 'carInfo' => array('carId' => $row['carId'], 'carName' => $row['carName'], 'carColor' => $row['carColor'], 'carOwnerId' => $row['carOwnerId']));
exit(json_encode($json));
?>