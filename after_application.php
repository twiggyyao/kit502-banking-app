<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '1') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Application</title>
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
            <h1>Credit Card Application</h1>

            <?php
            include ("./php/session.php");
            include ("./php/db_conn.php");

            // post and session some variable from previous page
            $username = $_SESSION['user']['username'];
            $user_id = $_SESSION['user']['user_id'];
            $from_acc = $_POST['from_acc'];
            $acc_type = $_POST['acc_type'];
            $currency = "AUD";

            if ($acc_type == "saving") {
                $amount = "50";
            } else if ($acc_type == "business"){
                $amount = "100";
            } else {
                echo "Error: Failed to charge the annual fee.";
            }

            // pay the annual fee to Secure Bank
            $to_user = "Secure Bank";
            $to_acc = "60003297";
            $purpose = "Card fee";
            include ("./php/intra_trans.php"); // Intra transfer: to insert transaction records

            //  create a new account which sort is credit
                $BSB = "506083";
                $acc_sort = "Credit";
                $day_mark = date('Y-m-d');
                if ($acc_type == "business") {
                    $day_limit = "50000";
                    $savingID = random_int(60000001, 60009999);
                } else {
                    $day_limit = "10000";
                    $savingID = random_int(40000001, 40009999);
                }
                $query = "INSERT INTO account_list (`BSB`, `user_id`, `username`, `acc_type`, `acc_sort`, `acc_id`,`balance`, `day_limit`, `day_mark`) 
                VALUES ('$BSB', '$user_id','$username','$acc_type','$acc_sort','$savingID','0','$day_limit','$day_mark')";
                $result = $mysqli->query($query);

                if ($result){
                } else {
                    echo "The application failed. Please try again.";
                }
            ?>
            <center>
            <h1>Your new credit card set up successful.</h1><br />
            <h2>Account ID: <?php echo $savingID?> <h2/>
            <h2>Account type: <?php echo $acc_type?> <h2/><br />

            <a href="login_application.php"><button>New Application</button></a>
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
                <p>Designed by LanYAO ( UserName: lyao0 StudentID: 506083 ) © 2019 Secure Bank Pty. Ltd</p>
            </center>
        </div>
    </div>

</body>

</html>