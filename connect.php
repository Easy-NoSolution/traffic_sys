<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 21/09/2017
 * Time: 09:38
 */

header("Content-Type:text/html; charset=utf-8");
header('Access-Control-Allow-Origin:*');
$connect = mysqli_connect('127.0.0.1', 'root', 'Nsu14310520420', 'traffic_sys');
if (!$connect) {
    echo 'It is failed to connect to database'.mysqli_error($connect);
}