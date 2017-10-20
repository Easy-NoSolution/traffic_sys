<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/10/2017
 * Time: 17:43
 */

require ('connect.php');

$carOwnerId = @$_GET['carOwnerId'] ? $_GET['carOwnerId'] : null;

if (empty($carOwnerId)) {
    $json = array('result' => 'failed', 'errorInfo' => 'carOwnerId is null');
    exit(json_encode($json));
}

$sql = "select distinct lawbreakerInfo_tb.carId, lawbreakerInfo_tb.carOwnerId, carOwner_tb.carOwnerName, carOwner_tb.carOwnerSex, carOwner_tb.carOwnerPhoneNumber, car_tb.carName, car_tb.carColor, lawbreakerInfo_tb.lawbreakerInfo from car_tb, carOwner_tb, lawbreakerInfo_tb where lawbreakerInfo_tb.carId = car_tb.carId and lawbreakerInfo_tb.carOwnerId = carOwner_tb.carOwnerId and carOwner_tb.carOwnerId = '{$carOwnerId}'";
$result = mysqli_query($connect, $sql);
$lawbreakerInfos = array();
$lawbreakerInfoId = 1;
while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    array_push($lawbreakerInfos, array('lawbreakerInfoId' => $lawbreakerInfoId++,'carId' => $row['carId'], 'carOwnerId' => $row['carOwnerId'], 'carOwnerName' => $row['carOwnerName'], 'carOwnerSex' => $row['carOwnerSex'], 'carOwnerPhoneNumber' => $row['carOwnerPhoneNumber'], 'carName' => $row['carName'], 'carColor' => $row['carColor'], 'lawbreakerInfo' => $row['lawbreakerInfo']));
}
$json = array('result' => 'success', 'lawbreakerInfos' => $lawbreakerInfos);
exit(json_encode($json));
?>