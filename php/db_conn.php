<?php
//connect to mysql
$mysqli = new mysqli('localhost', 'lyao0', '506083', 'lyao0');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>