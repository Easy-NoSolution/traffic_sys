<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 10/10/2017
 * Time: 16:03
 */

require ('connect.php');
$userId = @$_POST['userId'] ? $_POST['userId'] : null;
$userAvatar = 'null';
if ($_FILES['userAvatar']['error'] > 0) {
    $json = array('result' => 'failed', 'errorInfo' => $_FILES['userAvatar']['error']);
    exit(json_encode($json));
} else {
//    $userAvatar = addslashes(file_get_contents($_FILES['userAvatar']['tmp_name']));  获取图片数据
    $fillname = $_FILES['userAvatar']['name'];
    $dotArray = explode('.', $fillname);
    $type = end($dotArray);
    $path = "/usr/local/apache/htdocs/traffic_sys_pictures/" . $userId . '.' . $type;
//    move_uploaded_file($_FILES['userAvatar']['tmp_name'], $path);

    $json = array('result' => 'success', 'fillname' => $fillname, 'userId' => $userId, 'type' => $type, 'path' => $path);
    exit(json_encode($json));
}

?>