<?php

// This php needs the following variables：
    // $username
    // $from_acc
    // $to_bank
    // $to_bsb
    // $to_user
    // $to_acc
    // $amount
    // $purpose
    // $from_balance_1

// give some default variables
$bank = "Secure Bank";
$BSB = "506083";
$date = date('Y-m-d');
if ($currency == "EUR" ){
    $exc_rate = 1.62;
} else if ($currency == "USD" ){
    $exc_rate = 1.45;
} else if ($currency == "GBP" ){
    $exc_rate = 1.84;
} else if ($currency == "AUD" ){
    $exc_rate = 1;
} else {
    $exc_rate = 1;
}
$amount_1 = $amount * $exc_rate;


// get previous balance of Credit account and the aftet balance
$query = "SELECT `balance` FROM `account_list` WHERE (`acc_id` = $from_acc)";
$result_from = $mysqli->query($query);
$rows_from=mysqli_fetch_array($result_from);
$from_balance_0 = $rows_from['balance'];
$from_balance_1 = $from_balance_0 - $amount_1;

// get previous balance of Debit account and the aftet balance
$query = "SELECT `balance` FROM `account_list` WHERE (`acc_id` = $to_acc)";
$result_to = $mysqli->query($query);
$rows_to = mysqli_fetch_array($result_to);
$to_user_0 = $rows_to['username'];
$to_balance_0 = $rows_to['balance'];
$to_balance_1 = $to_balance_0 + $amount_1;

$query = "UPDATE `account_list` SET `balance`='$from_balance_1' WHERE acc_id = $from_acc;";
$result = $mysqli->query($query);

// instert this transaction as a credit set into trans_list (It can be seen by manager)
$query = "INSERT INTO trans_list(trans_date0,from_bank, from_bsb, from_user, from_acc, to_bank, to_bsb, to_user, to_acc, debit, credit, purpose, balance, amount_0, currency, exc_rate) 
VALUES ('$date','$bank','$BSB','$username','$from_acc','$to_bank','$to_bsb','$to_user','$to_acc',0,'$amount_1','$purpose','$from_balance_1','$amount','$currency','$exc_rate')";
$result = $mysqli->query($query);
$from_trans_id = mysqli_insert_id($mysqli);

//sent a message to credit user
$from_message = "You have paid ". $currency ."". $amount . " to ". $to_bank ." ". $to_bsb ." " . $to_user . " (" . $to_acc . ").";
$query = "INSERT INTO `message_list`( `username` , `from_username`, `message`) 
VALUES ('$username','Systerm','$from_message')";
$result = $mysqli->query($query);

// give some default variable
$bank = "Secure Bank";
$BSB = "506083";

// get previous balance of credit account before transaction and update after transaction
$query = "SELECT `balance` FROM `account_list` WHERE (`acc_id` = $from_acc)";
$result = $mysqli->query($query);
$rows=mysqli_fetch_array($result);
$from_balance_0 = $rows['balance'];
$from_balance_1 = $from_balance_0 - $amount;
$query = "UPDATE `account_list` SET `balance` = '$from_balance_1' WHERE acc_id = $from_acc;";
$result = $mysqli->query($query);

// instert this transaction as a credit set into trans_list (It can be seen by manager)
$query = "INSERT INTO trans_list(from_bank, from_bsb, from_user, from_acc, to_bank, to_bsb, to_user, to_acc, debit, credit, purpose, balance) 
VALUES ('$bank','$BSB','$username','$from_acc','$to_bank','$to_bsb','$to_user','$to_acc',0,'$amount','$purpose','$from_balance_1')";
$result = $mysqli->query($query);
$from_trans_id = mysqli_insert_id($mysqli);

//sent a message to credit user
$from_message = "You have paid " . $amount . " to " . $to_user . " (" . $to_acc . ").";
$query = "INSERT INTO `message_list`( `username` , `from_username`, `message`) 
VALUES ('$username','Systerm','$from_message')";
$result = $mysqli->query($query);

// echo $from_trans_id;
// echo "<br />";
// echo $from_acc;
// echo "<br />";
// echo $to_bank;
// echo "<br />";
// echo $to_bsb;
// echo "<br />";
// echo $to_user;
// echo "<br />";
// echo $to_acc;
// echo "<br />";
// echo $amount;
// echo "<br />";
// echo $purpose;
// echo "<br />";

?>