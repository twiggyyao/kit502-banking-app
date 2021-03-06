<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '1') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
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
                <li><a href="login_user.php">Balance</a></li>
                <li><a href="login_transaction.php">Transaction</a></li>
                <li><a href="login_payment.php">Bill Payment</a></li>
                <li><a href="login_statement.php">Statement</a></li>
                <li><a href="login_application.php">Application</a></li>
                <li><a href="login_message.php">Message</a></li>
            </ul>
        </div>
        <!--for different functions-->
        <div class="left">
            <h1>Bill Payment</h1>
            <?php
            include ("./php/session.php");
            include ("./php/db_conn.php");

            // post and session some variable from previous page
            $username = $_SESSION['user']['username'];
            $from_acc = $_POST['from_acc'];
            $amount = $_POST['amount'];
            $payment = $_POST['payment'];
            $currency = "AUD";

            // pay the power bill
                if ($payment == "power" ){
                $to_user = "Power Company";
                $to_acc = "60009069";
                $purpose = "Power fee";
                } else if ($payment == "water" ){
                    $to_user = "Water Company";
                    $to_acc = "60009235";
                    $purpose = "Water fee";
                } else if ($payment == "phone" ){
                    $to_user = "Phone Company";
                    $to_acc = "60002362";
                    $purpose = "Phone fee";
                } else if ($payment == "NBN" ){
                    $to_user = "NBN Company";
                    $to_acc = "60004142";
                    $purpose = "NBN fee";
                } else {
                    echo "error";
                }

                include ("./php/intra_trans.php"); // Intra transfer: to insert transaction records
            ?>

            <center>
                <h1>Your Payment is successful.</h1>
                <h2>Transaction ID: <?php echo $from_trans_id?> <h2/>
                From<br />
                <p>Bank: Secure Bank, BSB: 506083, User:<?php echo $userneame?>, Account ID: <?php echo $from_acc?></p>
                To<br />
                <p>Bank: Secure Bank, BSB: 506083, User: <?php echo $to_user?>, Account ID: <?php echo $to_acc?></p>
                <h2>Amount: <?php echo $amount?>,    Purpose: <?php echo $purpose?> </h2> <br />
                <a href="login_payment.php"><button>New Payment</button></a>
            </center> 

        </div>
        
        <!--for user's ditals and account management-->
        <div class="content">
            <h2>User Detials</h2>
            <br/>
            <h1>Hi, <?php echo $_SESSION['user']['username']?> !</h1>
            <p>User ID:<strong><?php echo $_SESSION['user']['user_id']?></strong></p>
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
                <p>Designed by LanYAO ( UserName: lyao0 StudentID: 506083 ) ?? 2019 Secure Bank Pty. Ltd</p>
            </center>
        </div>
    </div>

</body>

</html>