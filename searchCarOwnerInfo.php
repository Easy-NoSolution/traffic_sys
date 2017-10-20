<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/10/2017
 * Time: 17:42
 */

require ('connect.php');

$carOwnerId = @$_GET['carOwnerId'] ? $_GET['carOwnerId'] : null;

if (empty($carOwnerId)) {
    $json = array('result' => 'failed', 'errorInfo' => 'carOwnerId is null');
    exit(json_encode($json));
}

$sql = "select * from carOwner_tb where carOwnerId = '{$carOwnerId}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if (!$row) {
    $json = array("result" => 'failed', 'errorInfo' => "This carId is not exist", 'sql' => $sql);
    exit(json_encode($json));
}
$json = array("result" => 'failed', 'errorInfo' => "This carId is not exist", 'carOwnerId' => $row['carOwnerId'], 'carOwnerName' => $row['carOwnerName']);
exit(json_encode($json));
$json = array('result' => 'success', 'carOwnerInfo' => array('carOwnerId' => $row['carOwnerId'], 'carOwnerName' => $row['carOwnerName'], 'carOwnerSex' => $row['carOwnerSex'], 'carOwnerBithday' => $row['carOwnerBithday'], 'carOwnerAddress' => $row['carOwnerAddress'], 'carOwnerPhoneNumber' => $row['carOwnerPhoneNumber'], 'carOwnerAvatar' => $row['carOwnerAvatar']));
exit(json_encode($json));
?>