<!-- Non-display page
Access "1" is user permission.
Access "2" is the manager permission.
This php is used to guide different pages to different login permissions. -->

<?php
include("./php/session.php");
include("./php/db_conn.php");
$username = $_POST['username'];
$password = $_POST['password'];
$encodePW = md5($password);

// select the row which username is the same as $username
$query = "SELECT * FROM user_list WHERE username='$username'";
$result = mysqli_query($mysqli, $query);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

// guid defferent type of access to deferent page
if ($user['username'] != $username || $username == "") {
    header('Location: ./main.html?error=invalid_username');
} else if ($user['password'] == $encodePW) {
    $_SESSION['user'] = $user;
    // echo $_SESSION['user'];
    // var_dump($_SESSION);
    if ($user['access'] == '1') {
        header('Location: ./login_user.php');
    } else if ($user['access'] == '2') {
        header('Location: ./login_manager.php');
    } else {
        header('Location: ./main.html?error=invalid_password');
    }
} else {
    header('Location: ./main.html?error=unexpeceted_erro');
}
?>