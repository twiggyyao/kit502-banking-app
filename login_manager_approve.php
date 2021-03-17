<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '2') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Approve</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous">
    </script>

</head>

<body>
    <!--Header part for logo, log out and avigation bar-->
    <div id="div1">
        <div id="div_logo">
            <a href="main.html"><img id="logo" src="./img/logo.png" /></a>
        </div>
        <div id="sign_up">
            <a href="logout.php"><button>log out</button></a>
        </div>
    </div>

    <div id="div2">
        <!--different button connect to different pages-->
        <div id="bar">
            <ul>
                <li><a href="login_manager.php">Add Users</a></li>
                <li><a href="login_manager_update.php">Manage Users</a></li>
                <li><a href="login_manager_delete.php">Manage Accounts</a></li>
                <li><a href="login_manager_trans.php">Wiew Transactions</a></li>
                <!-- <li><a href="login_manager_approve.php">Approve Transactions</a></li> -->
            </ul>
        </div>
        <!--for different functions-->
        <div class="left">
            <center>
            <h1>Approve Transactions</h1>
                
            </center>
        </div>
        <!--for user's ditals and account management-->
        <div class="content">
            <h2>Manager Detials</h2>
            <br/>
            <h1>Hi, <?php echo $_SESSION['user']['username']?> !</h1>
            <p>Manager ID:<strong><?php echo $_SESSION['user']['user_id']?></strong></p>
            <p>Last login time is</p>
            <p> <strong><?php echo $_SESSION['user']['login_time']?></strong></p>
            <p>Email: </p>
            <p><strong><?php echo $_SESSION['user']['email']?></strong></p>
            <p>Mobile:<strong><?php echo $_SESSION['user']['mobile']?></strong></p>
        </div>
    </div>

    <!--Foot part, for conection-->
    <div id="div3">
        <div id="contact">
            <img src="img/phone.png" style="width:240px; height:auto" />
            <br />
            <a href="https://www.facebook.com/"><img src="./img/fb.png" style="width:50px; height:50px" /></a>
            <a href="https://www.twitter.com/"><img src="./img/tw.png" style="width:50px; height:50px" /></a>
            <a href="https://www.youtube.com/"><img src="./img/yt.png" style="width:50px; height:50px" /></a>
            <center>
                <p>Designed by LanYAO ( UserName: lyao0 StudentID: 506083 ) © 2019 Secure Bank Pty. Ltd</p>
            </center>
        </div>
    </div>

</body>

</html>