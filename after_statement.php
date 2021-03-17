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
            <h1>Secure Bank Statement </h1>
            <div class="tableDiv300">
                <?php
                include("./php/session.php");
                include("./php/db_conn.php");

                // post and session some variable from previous page
                $username = $_SESSION['user']['username'];
                $from_acc = $_POST['from_acc'];
                $period = $_POST['period'];
                if ($period == 30) {
                    $amount = "2.5";
                } else if ($period == 90) {
                    $amount = "5";
                } else if ($period == 180) {
                    $amount = "7";
                } else {
                    echo "Error: Failed to charge the Statement fee.";
                }
                $to_user = "Secure Bank";
                $to_acc = "60003297";
                $purpose = "Statement fee";
                $currency = "AUD";
                include("./php/intra_trans.php"); // Intra transfer: to insert transaction records

                // Search Account details in account_list
                $query = "SELECT * FROM account_list where acc_id = $from_acc";
                $result = $mysqli->query($query);
                // Show the Account details as a table
                if ($result->num_rows > 0) {
                    echo "<table><tr></tr>";
                    echo " <table>
            <th>BSB</th> <th>User ID</th> <th>User Name</th> <th>Account Type</th> <th>Account Sort</th> <th>Account ID</th> <th>Balance</th>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["BSB"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["acc_type"] . "</td>";
                        echo "<td>" . $row["acc_sort"] . "</td>";
                        echo "<td>" . $row["acc_id"] . "</td>";
                        echo "<td>" . $row["balance"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "empty table";
                }

                echo "<br/><br/>";

                // Search Account transaction history
                if ($period == 30) {
                    $query = "SELECT * FROM trans_list where from_acc = $from_acc and DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(trans_date)";
                    $result = $mysqli->query($query);
                } else if ($period == 90) {
                    $query = "SELECT * FROM trans_list where from_acc = $from_acc and DATE_SUB(CURDATE(), INTERVAL 90 DAY) <= date(trans_date)";
                    $result = $mysqli->query($query);
                } else if ($period == 180) {
                    $query = "SELECT * FROM trans_list where from_acc = $from_acc and DATE_SUB(CURDATE(), INTERVAL 180 DAY) <= date(trans_date)";
                    $result = $mysqli->query($query);
                } else {
                    echo "No transaction history.";
                }
                // Show the Account transaction history as a table
                if ($result->num_rows > 0) {
                    echo "<table><tr></tr>";
                    echo " <table>
            <th>Date/Transaction ID</th> <th>Form Bank/BSB/User/Account</th> <th>To Bank/BSB/User/Account</th> <th>Debit</th> <th>Credit</th> <th>Purpose</th> <th>Balance</th>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["trans_date"] . "  " . $row["trans_id"] . "</td>";
                        echo "<td>" . $row["from_bank"] . " " . $row["from_bsb"] . " " . $row["from_user"] . " " . $row["from_acc"] . "</td>";
                        echo "<td>" . $row["to_bank"] . " " . $row["to_bsb"] . " " . $row["to_user"] . " " . $row["to_acc"] . "</td>";
                        echo "<td>" . $row["debit"] . "</td>";
                        echo "<td>" . $row["credit"] . "</td>";
                        echo "<td>" . $row["purpose"] . "</td>";
                        echo "<td>" . $row["balance"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "empty table";
                }
                ?>
            </div>
        </div>
        <!--for user's ditals and account management-->
        <div class="content">
            <h2>User Detials</h2>
            <br />
            <h1>Hi, <?php echo $_SESSION['user']['username'] ?> !</h1>
            <p>User ID:<strong><?php echo $_SESSION['user']['user_id'] ?></strong></p>
            <p>Last login time is</p>
            <p> <strong><?php echo $_SESSION['user']['login_time'] ?></strong></p>
            <p>Email: </p>
            <p><strong><?php echo $_SESSION['user']['email'] ?></strong></p>
            <p>Mobile:<strong><?php echo $_SESSION['user']['mobile'] ?></strong></p>
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