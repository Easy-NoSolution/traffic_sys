<HTML>
<HEAD>
    <TITLE>List BLOB Images</TITLE>
    <link href="imageStyles.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
<?php
while($row = mysqli_fetch_array($result)) {
    ?>
    <img src="imageView.php?userId=123" /><br/>
    <?php
}
mysqli_close($conn);
?>
</BODY>
</HTML>