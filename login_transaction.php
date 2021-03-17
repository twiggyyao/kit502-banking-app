<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '1') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Transaction</title>
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
                <h1>Intra Bank Transaction</h1>
                <form id="intra_trans" method="post" action="./after_intra_trans.php" onsubmit="return validate();">
                    From Account ID
                    <select name="from_acc" id="from_acc" action="">
                        <?php
                        include ("./php/db_conn.php");
                        $query = "SELECT * from account_list where username='".$_SESSION['user']['username']."'";
                        $result = $mysqli->query($query);
                        while($row=$result->fetch_assoc()){
                            echo '<option>'.$row['acc_id'].'</option>';
                        }
                        ?>
                    </select>
                    To
                    <select name="to_acc" id="to_acc" action="">
                        <?php
                        include ("./php/db_conn.php");
                        $query = "SELECT * from account_list where acc_id";
                        $result = $mysqli->query($query);
                        while($row=$result->fetch_assoc()){
                            echo '<option>'.$row['username'].' '.$row['acc_id'].'</option>';
                        }
                        ?>
                    </select>
                    <br /><br />
                    Amount
                    <select name="currency" id="currency">
                        <option value="AUD">AUD</option>
                        <option value="EUR">EUR 1:1.62</option>
                        <option value="USD">USD 1:1.45</option>
                        <option value="GBP">USD 1:1.84</option>
                    </select>
                    <input type="text" name="amount" id="amount" placeholder="Amount" />
                    Purpose
                    <input type="text" name="purpose" id="purpose" placeholder="Purpose" />
                    <br /><br />
                    <input type="submit" value="Submit" name="submit" id="submit" />
                </form>
                <br />
                <h1>Inter Bank Transaction</h1>
                <form id="inter_trans" method="post" action="./after_inter_trans.php" onsubmit="return validate();">
                    From Account ID
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
                    To
                    <input type="text" name="to_bank" id="to_bank" placeholder="Bank Name" />
                    <input type="text" name="to_bsb" id="to_bsb" placeholder="BSB" />
                    <input type="text" name="to_user" id="to_user" placeholder="User Name" />
                    <input type="text" name="to_acc" id="to_acc" placeholder="Account ID" />
                    <br /><br />
                    Amount
                    <select name="currency" id="currency">
                        <option value="AUD">AUD</option>
                        <option value="EUR">EUR 1:1.62</option>
                        <option value="USD">USD 1:1.45</option>
                        <option value="GBP">USD 1:1.84</option>
                    </select>
                    <input type="text" name="amount" id="amount" placeholder="Amount" />
                    Purpose
                    <input type="text" name="purpose" id="purpose" placeholder="Purpose" /><br /><br />
                    <input type="submit" value="Submit" name="submit" id="submit" />
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