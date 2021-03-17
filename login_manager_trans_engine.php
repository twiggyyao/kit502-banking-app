<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '2') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>View</title>
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
                <h1>View Transactions</h1>
                <form id="back" action="login_manager_trans.php" ;">
                    <input type="submit" name="back" value="Back to View more">
                </form>
                <div class="tableDiv250">
                    <?php
                    // print all existing user lists by the piored
                    include './php/db_conn.php';
                    $period = $_POST['date'];

                    if ($period == 1) {
                        $query = "SELECT * FROM trans_list where DATE_SUB(CURDATE(), INTERVAL 1 DAY) <= date(trans_date)";
                        $result = $mysqli->query($query);
                    } else if ($period == 7) {
                        $query = "SELECT * FROM trans_list where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(trans_date)";
                        $result = $mysqli->query($query);
                    } else if ($period == 30) {
                        $query = "SELECT * FROM trans_list where DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date(trans_date)";
                        $result = $mysqli->query($query);
                    } else if ($period == 90) {
                        $query = "SELECT * FROM trans_list where DATE_SUB(CURDATE(), INTERVAL 90 DAY) <= date(trans_date)";
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
            </center>
        </div>
        <!--for user's ditals and account management-->
        <div class="content">
            <h2>Manager Detials</h2>
            <br />
            <h1>Hi, <?php echo $_SESSION['user']['username'] ?> !</h1>
            <p>Manager ID:<strong><?php echo $_SESSION['user']['user_id'] ?></strong></p>
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