<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 18/09/2017
 * Time: 15:16
 */

require ('connect.php');

$json = array('result' => 'success');
exit(json_encode($json));
mysqli_free_result($connect);