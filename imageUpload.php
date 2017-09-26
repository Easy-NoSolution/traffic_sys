<?php
header("Content-Type: image/jpg; charset=UTF-8");
if(count($_FILES) > 0) {
    if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        require ('connect.php');
        $data =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
        $userId = '123';
        $username = 'fjsk';
        $userSex = 0;
        $userBirthday = 'NULL';
        $password = 'kfskldjf';
//        $sql = "INSERT INTO output_images(imageType ,imageData)  VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $sql = "insert into user_tb (userId, username, userSex, userBirthday, userAvatar, password) values ('".$userId."', '".$username."', ".$userSex.", ".$userBirthday.", ".$data.", '".$password."')";
        $current_id = mysqli_query($connect, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" .
            mysqli_error());
        if(isset($current_id)) {
            header("Location: listImages.php");
        }}}
?>
