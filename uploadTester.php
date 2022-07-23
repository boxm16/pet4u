

<?php
echo "post_max: " . ini_get('post_max_size') . "<br>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize')  . "<br>";
echo "Trying to set values<br>";
ini_set('post_max_size','16M');
ini_set('upload_max_filesize','16M');
echo "post_max: " . ini_get('post_max_size');
echo "<br>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize');
?>
