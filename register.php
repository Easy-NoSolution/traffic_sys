<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/09/2017
 * Time: 15:16
 */

require ('connect.php');
$userId = @$_POST['userId'] ? $_POST['userId'] : NULL;
$json = array('result' => 'success', 'userId' => $userId);
exit(json_encode($json));
mysqli_free_result($connect);