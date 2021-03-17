<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '1') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Statement</title>
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
            <center>
            <h1>Secure Bank Statement </h1>
            <form id="eStatement" method="post" action="./after_statement.php" onsubmit="return validate();">

            Choose your account
            <select name="from_acc" id="from_acc">
                <?php
                include ("./php/db_conn.php");
                $query = "SELECT * from account_list where username='".$_SESSION['user']['username']."'";
                $result = $mysqli->query($query);
                while($row=$result->fetch_assoc()){
                    echo '<option>'.$row['acc_id'].'</option>';
                }
                ?>
            </select>
            <br /><br />
            Choose Statement period 
                <input name="period" type="radio" value="30" id="30" />
                <label for="power">1 Month</label>
                <input name="period" type="radio" value="90" id="90" />
                <label for="water">3 Month</label>
                <input name="period" type="radio" value="180" id="180" />
                <label for="phone">6 Month</label><br /><br />
                <br />
                <input type="submit" value="submit" name="submit" id="submit" />
                <br /><br /><br />
            <h2>Notice</h2>
            <p> Each Bank Statement for 1 Month will charge you $2.50 fee.</p> 
            <p> Each Bank Statement for 3 Month will charge you $5.00 fee.</p>
            <p> Each Bank Statement for 6 Month will charge you $7.00 fee.</p>        
            </form>
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