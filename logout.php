<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">

</head>

<body>
    <!--header part only for logo-->
    <div id="div1">
        <a href="main.html"><img id="logo" src="./img/logo.png" /></a>
    </div>
    <!--middle part for registing-->
    <div id="div2">
        <?php

        include ("./php/session.php");
        include ("./php/db_conn.php");
        $username = $_SESSION ['user']['username'];
        $logout_time = date ("Y-m-d H:i:s", time()+10*3600) ;
        $query = "UPDATE user_list SET login_time = '$logout_time' WHERE username = '$username'";
        $result = $mysqli->query($query);
      
        // session_start();
        // Remove session variables
        session_unset();
        // Destroy the session
        session_destroy();
        echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><h2>". $logout_time . "</h2><h1>You have logged out successfully.</h1><br />";
        echo '<h1><a href="main.html">Return to main page</a></h1>';
        ?>

    </div>
    <!--Foot part, for conection-->
    <div id="div3">
        <div id="contact">
            <center>
                <br /><br /><br /><br /><br /><br />
                <p>Designed by LanYAO ( UserName: lyao0 StudentID: 506083 ) © 2019 Secure Bank Pty. Ltd</p>
            </center>
        </div>
    </div>
</body>

</html>