<?php
/**
 * Created by PhpStorm.
 * User: yiwujie
 * Date: 25/09/2017
 * Time: 17:12
 */
header('content-type: image/png;');
$content = file_get_contents('/tmp/userAvatar.png');
echo $content;
?>