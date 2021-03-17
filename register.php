<!DOCTYPE html>
<html>

<head>
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://jquery.validate.js"></script>
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
                alert("Regist sucssisfully! Please login.");
            }
        }
    </script>

</head>

<body>
    <!--header part only for logo-->
    <div id="div1">
        <a href="main.html"><img id="logo" src="./img/logo.png" /></a> 
    </div>
    <!--middle part for registing-->
    <div id="div2">
        <div id="register"> 
        <h1 class="heading">User Registration</h1>
        <center>
        <form id="register" method="post" action="./register_engine.php" onsubmit="return validate();">
            <input type="text" name="username" id="username" placeholder="Username" />
            <input type="password" name="password" id="password" placeholder="Possword" />
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm password" />
            <input type="text" name="email" id="email" placeholder="Email" />
            <input type="text" name="mobile" id="mobile" placeholder="Mobile" />
            <br /><br />
            <label for="gender">Account Type</label><br /><br />
            <div id="type_chose">
                <input name="acc_type" type="radio" value="saving" id="saving" />
                <label for="male">Saving</label>
                <input name="acc_type" type="radio" value="business" id="business" />
                <label for="female">Business</label>
            </div>
            <br /><br /><br />

            <input type="submit" value="Sign up" name="submit" id="submit" />
        </form>
        </center>
        </div>
    </div>

    <!--Foot part, for conection-->
    <div id="div3">
        <div id="contact">
            <center>
                <br /><br /><br /><br /><br /><br />
                <p>Designed by LanYAO ( UserName: lyao0  StudentID: 506083 ) © 2019 Secure Bank Pty. Ltd</p>
            </center>
        </div>
    </div>

</body>

</html>