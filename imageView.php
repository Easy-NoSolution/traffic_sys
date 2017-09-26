<?php
header("Content-Type: image/jpg; charset=UTF-8");
require ('connect.php');
if(isset($_GET['userId'])) {
    $sql = "SELECT userAvatar FROM user_tb WHERE userId=".$_GET['userId'];
    $result = mysqli_query($connect, $sql, MYSQLI_BOTH) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>"
        . mysqli_error());
    $row = mysqli_fetch_array($result);
    header("Content-type: image/jpg");
    echo $row["imageData"];
}
mysqli_close($conn);
?>