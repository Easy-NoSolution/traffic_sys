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

//$data = @addslashes(fread(fopen($userAvatar, "r"), filesize($userAvatar))) ? addslashes(fread(fopen($userAvatar, "r"), filesize($userAvatar))) : 'NULL';
$userBirthday = 'NULL';
//$userAvatar = @$_POST['userAvatar'] ? $_POST['userAvatar'] : 'NULL';
$password = @$_POST['password'] ? $_POST['password'] : NULL;
$userAvatar = 'NULL';
$data = 'NULL';
if ($_FILES['userAvatar']['error'] > 0) {
    $json = array('result' => $_FILES['userAvatar']['error']);
    exit(json_encode($json));
} else {
    $fillname = $_FILES['userAvatar']['name'];
    $dotArray = explode('.', $fillname);
    $type = end($dotArray);
    $userAvatar = $_FILES['userAvatar']['tmp_name'];
    move_uploaded_file($_FILES['userAvatar']['tmp_name'], "/tmp/".$_FILES['userAvatar']['name']);
    $json = array('result' => 'It is success to upload userAvatar', 'fillname' => $fillname, 'userAvatar' => $userAvatar);
    exit(json_encode($json));
}

if (empty($userId) and empty($username) and empty($userSex) and empty($password)) {
    $json = array('result' => 'Some value is NULL');
    exit(json_encode($json));
}

//if ($userAvatar == 'NULL' or $data == 'NULL') {
//    $json = array('result' => 'userAvatar value is NULL');
//    exit(json_encode($json));
//}

$sql = "insert into user_tb (userId, username, userSex, userBirthday, userAvatar, password) values ('".$userId."', '".$username."', ".$userSex.", ".$userBirthday.", ".$data.", '".$password."')";
if (!mysqli_query($connect, $sql)) {
    $json = array('result' => 'It is failed to insert data to database!', 'sql' => $sql);
    exit(json_encode($json));
}

$json = array('result' => 'success');
exit(json_encode($json));
mysqli_free_result($connect);
?>