<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/10/2017
 * Time: 17:41
 */

require ('connect.php');
$carOwnerId = @$_POST['carOwnerId'] ? $_POST['carOwnerId'] : null;
$carOwnerName = @$_POST['carOwnerName'] ? $_POST['carOwnerName'] : null;
$carOwnerSex = @$_POST['carOwnerSex'] ? $_POST['carOwnerSex'] : 0;
$carOwnerBirthday = @$_POST['carOwnerBirthday'] ? $_POST['carOwnerBirthday'] : null;
$carOwnerBirthday = strtotime($carOwnerBirthday);
$carOwnerAddress = @$_POST['carOwnerAddress'] ? $_POST['carOwnerAddress'] : null;
$carOwnerPhoneNumber = @$_POST['carOwnerPhoneNumber'] ? $_POST['carOwnerPhoneNumber'] : null;

$carOwnerAvatar = 'null';
if ($_FILES['carOwnerAvatar']['error'] > 0) {
    $json = array('result' => 'failed', 'errorInfo' => $_FILES['carOwnerAvatar']['error']);
    exit(json_encode($json));
} else {
//    $userAvatar = addslashes(file_get_contents($_FILES['userAvatar']['tmp_name']));  获取图片数据
    $fillname = $_FILES['carOwnerAvatar']['name'];
    $dotArray = explode('.', $fillname);
    $type = end($dotArray);
    $carOwnerAvatar = "/traffic_sys_pictures/user_pics/".$carOwnerId.'.'.$type;
    $path = "/usr/local/apache/htdocs".$carOwnerAvatar;
//    上传时要去虚拟机下修改文件夹的权限 chmod 777 /usr/local/apache/htdocs/traffic_sys_pictures
//    否则会报错 Error Domain=NSCocoaErrorDomain Code=3840 "JSON text did not start with array or object and option to allow fragments not set." UserInfo={NSDebugDescription=JSON text did not start with array or object and option to allow fragments not set.}
    move_uploaded_file($_FILES['carOwnerAvatar']['tmp_name'], $path);
}

if (empty($carOwnerId) and empty($carOwnerName) and empty($carOwnerSex) and empty($carOwnerBirthday) and empty($carOwnerAddress) and empty($carOwnerPhoneNumber)) {
    $json = array('result' => 'failed', 'errorInfo' => 'Some value is null');
    exit(json_encode($json));
}

$sql = "select * from carOwner_tb where carOwnerId = '{$carOwnerId}'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
if ($row) {
    $json = array("result" => 'failed', 'errorInfo' => "This account has exist! Please enter another account", 'sql' => $sql);
    exit(json_encode($json));
}

$sql = "insert into carOwner_tb (carOwnerId, carOwnerName, carOwnerSex, carOwnerBirthday, carOwnerAddress, carOwnerPhoneNumber, carOwnerAvatar) values ('{$carOwnerId}', '{$carOwnerName}', {$carOwnerSex}, '{$carOwnerBirthday}', '{$carOwnerAddress}', '{$carOwnerPhoneNumber}', '{$carOwnerAvatar}')";
if (!mysqli_query($connect, $sql)) {
    $json = array('result' => 'failed', 'errorInfo' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));

?>