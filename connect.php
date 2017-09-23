<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 21/09/2017
 * Time: 09:38
 */

header("Content-Type:text/html; charset=utf-8");
header('Access-Control-Allow-Origin:*');
$connect = mysqli_connect('127.0.0.1', 'root', 'Nsu14310520420');
$json = array();
if (!$connect) {
    $json = array('result' => 'It is failed to connect to database'.mysqli_error($connect));
    exit(json_encode($json));
}

mysqli_select_db($connect, 'traffic_sys');

?>