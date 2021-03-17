<?php
// Creat connection
include("./php/db_conn.php");

// Give some money to the new account for the convenience of presentation communication
$initial_amount = 5000;

// Get values from the form
$username = $_POST["username"];
$password = $_POST["password"];
$encodePW = md5($password);
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$acc_type = $_POST["acc_type"];
$datetime = date('Y-m-d H:i:s');

// $session_user = $row['username'];
// $_SESSION['session_user'] = $session_user;

// Insert data into the table
$query = "INSERT INTO user_list (username,password,email,mobile,access,login_time) 
    VALUES('$username','$encodePW','$email','$mobile','1','$datetime')";
$result = $mysqli->query($query);
$user_id = mysqli_insert_id($mysqli);

if ($result) {
    // add a new saving account in account_list
    $BSB = 506083;
    $acc_sort = Debit;
    $day_mark = date('Y-m-d');
    if ($acc_type == "business") {
        $day_limit = "50000";
        $savingID = random_int(60000001, 60009999);
    } else {
        $day_limit = "10000";
        $savingID = random_int(40000001, 40009999);
    }
    $query = "INSERT INTO account_list (`BSB`, `user_id`, `username`, `acc_type`, `acc_sort`, `acc_id`,`balance`, `day_limit`, `day_mark`) 
    VALUES ('$BSB', '$user_id','$username','$acc_type','$acc_sort','$savingID','$initial_amount','$day_limit','$day_mark')";
    $result = $mysqli->query($query);
    header('Location: ./login_manager.php');
} else {
    echo "Registration failed.";
    echo '<a href="./main.html">back to main page.</a>';
}
$mysqli_free_result($result);
$mysqli->close();
?>