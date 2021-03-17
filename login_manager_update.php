<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '2') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update</title>
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
                <h1>Manage Users</h1>
                <form id="manage_acc" method="Get" action="login_manager_update.php";">
                    <!-- Update & delete table -->
                    <lable>Choose a User</lable>
                    <select name="username" id="username">
                        <?php
                        include("./php/db_conn.php");
                        $query = "SELECT * from user_list";
                        $result = $mysqli->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo '<option>' . $row['username'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" id="email" name="email" placeholder="Email">
                    <input type="text" id="mobile" name="mobile" placeholder="Mobile">
                    <select id="access" name="access">
                        <option value="1">1.Bank Holder</option>
                        <option value="2">2.Manager</option>
                    </select>
                    <input type="submit" name="update" value="Update">
                    <input type="submit" name="delete" value="Delete">
                    <p>Notice: If you delete a user, all accounts under his/her name will be deleted synchronously.</p>
                </form>
                <div class="tableDiv200">
                <?php
                // print all existing user lists
                include './php/db_conn.php';
                $query = "SELECT * FROM user_list ORDER BY `user_id`";
                $result = $mysqli->query($query);

                if ($result->num_rows > 0) {
                    echo "<table><tr></tr>";
                    echo " <table>
                    <th>User ID</th> <th>User Name</th> <th>Email</th> <th>Mobile</th> <th>Access</th>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["mobile"] . "</td>";
                        echo "<td>" . $row["access"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "empty table";
                }

                // Update/Delete function
                if (isset($_REQUEST['update']) && isset($_REQUEST['username'])) {
                    $username = $_REQUEST['username'];
                    $email = $_REQUEST['email'];
                    $mobile = $_REQUEST['mobile'];
                    $access = $_REQUEST['access'];
                    $query = "UPDATE user_list SET email='$email', mobile='$mobile', access='$access' WHERE username='$username'";
                    if ($mysqli->query($query) === true) {
                        echo "Update successfully";
                        header("Location: login_manager_update.php");
                        exit;
                    } else {
                        echo "register error! ==> $query";
                    }
                } else if (isset($_REQUEST['delete']) && isset($_REQUEST['username'])) {
                    $username = $_REQUEST['username'];
                    $query = "DELETE FROM user_list WHERE username='$username'";
                    $resault = $mysqli->query($query);
                    $query = "DELETE FROM account_list WHERE username='$username'";
                    $resault = $mysqli->query($query);
                    if ($mysqli->query($query) === true) {
                        echo "Update successfully";
                        header("Location: login_manager_update.php");
                        exit;
                    } else {
                        echo "register error! ==> $query";
                    }
                }
                // $mysqli->close();
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