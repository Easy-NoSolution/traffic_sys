<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/09/2017
 * Time: 15:16
 */

require ('connect.php');
$userId = @$_POST['userId'] ? $_POST['userId'] : NULL;
$username = @$_POST['username'] ? $_POST['username'] : NULL;
$userSex = @$_POST['userSex'] ? $_POST['userSex'] : 0;
//$userBirthday = @$_POST['userBirthday'] ? $_POST['userBirthday'] : 'NULL';
//$userBirthday = date('Y-m-d h:i:s');
$userBirthday = 'NULL';
//$userAvatar = @$_POST['userAvatar'] ? $_POST['userAvatar'] : 'NULL';
$password = @$_POST['password'] ? $_POST['password'] : NULL;
$userAvatar = 'NULL';

if (empty($userId) and empty($username) and empty($userSex) and empty($password)) {
    $json = array('result' => 'Some value is NULL');
    exit(json_encode($json));
}

//if ($userAvatar == 'NULL') {
//    $userAvatar = $_FILES['userAvatar']['name'];
//}

$sql = "insert into user_tb (userId, username, userSex, userBirthday, userAvatar, password) values ('".$userId."', '".$username."', ".$userSex.", ".$userBirthday.", ".$userAvatar.", '".$password."')";
if (!mysqli_query($connect, $sql)) {
    $json = array('result' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));
mysqli_free_result($connect);
?>