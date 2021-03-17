<?php
include('./php/session.php');
if (isset($_SESSION['user']) == '' || $_SESSION['user']['access'] != '2') {
    header('Location: ./error.html');
} else { }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Insert</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous">
    </script>
    <!--Validation process-->
    <script>
        function validate() {
            $('.error').remove();
            var special_symbol = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!#$]).{8,12}$/;
            var criteria = special_symbol.test($('input[name="password"]').val());
            if ($('input[name="username"]').val() == "") {
                $('input[name="username"]').after('<div class="error">Please enter your full name.</div>');
                event.preventDefault();
                return false;
            } else if ($('input[name="password"]').val() == "") {
                $('input[name="password"]').after('<div class="error">Please enter your password.</div>');
                event.preventDefault();
                return false;
            } else if (criteria == false) {
                $('input[name="password"]').after('<div class="error">Password needs 8 to 12 characters in length, including lower, upper and special characters (~ ! # $).</div>');
                event.preventDefault();
                return false;
            } else if ($('input[name="confirmpassword"]').val() == "") {
                $('input[name="confirmpassword"]').after('<div class="error">Please re-type your password.</div>');
                event.preventDefault();
                return false;
            } else if ($('input[name="confirmpassword"]').val() != $('input[name="password"]').val()) {
                $('input[name="confirmpassword"]').after('<div class="error">Password does not match.</div>');
                event.preventDefault();
                return false;
            } else if ($('input[name="email"]').val() == "") {
                $('input[name="email"]').after('<div class="error">Please enter your Email.</div>');
                event.preventDefault();
                return false;
            } else if ($('input[name="mobile"]').val() == "") {
                $('input[name="mobile"]').after('<div class="error">Please enter your mobile.</div>');
                event.preventDefault();
                return false;
            } else {
                alert("Regist sucssisfully! Please see the Users in Manage User page.");
            }
        }
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
                <h1>Add Users</h1>
                <form id="add_acc" method="POST" action="login_manager_engine.php" onsubmit="return validate();">
                    <input type="text" name="username" id="username" placeholder="Username" /> <br/>
                    <input type="password" name="password" id="password" placeholder="Possword" /><br/>
                    <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm password" /><br/>
                    <input type="text" name="email" id="email" placeholder="Email" /><br/>
                    <input type="text" name="mobile" id="mobile" placeholder="Mobile" />
                    <br /><br />
                    <select name="acc_type" id="acc_type">
                        <option value="saving">Account Type: Saving</option>
                        <option value="business">Account Type: Business</option>
                    </select>
                    <input type="submit" value="Sign up" name="signup" id="signup" />
                </form>
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