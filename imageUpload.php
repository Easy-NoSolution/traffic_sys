<?php
header("Content-Type: image/jpg; charset=UTF-8");
if(count($_FILES) > 0) {
    if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        require ('connect.php');
        $data =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
        $userId = '126';
        $username = 'ffff';
        $userSex = 0;
        $userBirthday = date('Y-m-d');
        $password = 'kfskldjf';
//        $sql = "INSERT INTO output_images(imageType ,imageData)  VALUES('{$imageProperties['mime']}', '{$imgData}')";
//        $sql = "insert into user_tb (userId, username, userSex, userBirthday, userAvatar, password) values ('".$userId."', '".$username."', ".$userSex.", ".$userBirthday.", ".$data.", '".$password."')";
        $sql = "insert into user_tb (userId, username, userSex, userBirthday, userAvatar, password) values ('{$userId}', '{$username}', '{$userSex}', '{$userBirthday}', '{$data}', '$password}')";

        $current_id = mysqli_query($connect, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" .
            mysqli_error($connect));
        if(isset($current_id)) {
            header("Location: listImages.php");
        }}}
?>
