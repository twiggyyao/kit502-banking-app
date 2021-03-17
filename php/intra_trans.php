<?php

// This php needs the following variables：
    // $username
    // $from_acc
    // $to_user
    // $to_acc
    // $amount
    // $purpose
    // $from_balance_1
    // $currency


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

// $date_mark_0 = $rows_from['day_mark'];
// $date_mark_1 = date(H-m-d);
// $from_limit = $rows_from['day_limit'];
// $from_acc_type = $rows_from['acc_type'];
// if ($date_mark_0 == $date_mark_1 ){
//     $from_limit_0 = $from_limit;
// } else if ($from_acc_type == "business"){
//     $from_limit_0 = 50000;
// } else {
//     $from_limit_0 = 10000;
// }
// $from_limit_1 = $from_limit_0 - $amount_1;

// get previous balance of Debit account and the aftet balance
$query = "SELECT `balance` FROM `account_list` WHERE (`acc_id` = $to_acc)";
$result_to = $mysqli->query($query);
$rows_to = mysqli_fetch_array($result_to);
$to_user_0 = $rows_to['username'];
$to_balance_0 = $rows_to['balance'];
$to_balance_1 = $to_balance_0 + $amount_1;

// Determine if the transaction is possible
// if ($from_balance_1<0) {
//     $error = "Error: Insufficient account balance.";
// } else if ($from_limit_1<0) {
//     $error = "Error: Today‘s transfer limit is ". $from_limit_0 .". Insufficient limited balance.";
// }
// else if (iesst($result_to)!= true || $to_user_0!=$to_user){
//     $error = "Error: Debit account does not exist.";
// } else if ($amount_1>25000){
//     $error = "Waiting for approval: Since the single transaction amount is greater than $25000, please wait for the manager to approve this transaction.";
//     // Upadte the day limit
//     $query = "UPDATE `account_list` SET `balance`='$from_balance_1' and `day_limit`='$from_limit_1' and `day_mark`='$date_mark_1' WHERE acc_id = $from_acc;";
//     $result = $mysqli->query($query);

//     // instert this transaction as a credit set into approve_list
//     $query = "INSERT INTO approve_list(trans_date0,from_bank, from_bsb, from_user, from_acc, to_bank, to_bsb, to_user, to_acc, debit, credit, purpose, balance, amount_0, currency, exc_rate) 
//     VALUES ('$date','$bank','$BSB','$username','$from_acc','$bank','$BSB','$to_user','$to_acc',0,'$amount_1','$purpose','$from_balance_1','$amount','$currency','$exc_rate')";
//     $result = $mysqli->query($query);
//     $from_trans_id = mysqli_insert_id($mysqli);

//     //sent a message to credit user
//     $from_message = "Waiting: You have paid ". $currency ."". $amount . " to " . $to_user . " (" . $to_acc . "). Please waite for approving.";
//     $query = "INSERT INTO `message_list`( `username` , `from_username`, `message`) 
//     VALUES ('$username','Systerm','$from_message')";
//     $result = $mysqli->query($query);

// } else {
//     $success = "Y";
        // get previous balance of credit account before transaction and update after transaction
        $query = "UPDATE `account_list` SET `balance`='$from_balance_1' WHERE acc_id = $from_acc;";
        $result = $mysqli->query($query);

        // instert this transaction as a credit set into trans_list (It can be seen by manager)
        $query = "INSERT INTO trans_list(trans_date0,from_bank, from_bsb, from_user, from_acc, to_bank, to_bsb, to_user, to_acc, debit, credit, purpose, balance, amount_0, currency, exc_rate) 
        VALUES ('$date','$bank','$BSB','$username','$from_acc','$bank','$BSB','$to_user','$to_acc',0,'$amount_1','$purpose','$from_balance_1','$amount','$currency','$exc_rate')";
        $result = $mysqli->query($query);
        $from_trans_id = mysqli_insert_id($mysqli);

        //sent a message to credit user
        $from_message = "You have paid ". $currency ."". $amount . " to " . $to_user . " (" . $to_acc . ").";
        $query = "INSERT INTO `message_list`( `username` , `from_username`, `message`) 
        VALUES ('$username','Systerm','$from_message')";
        $result = $mysqli->query($query);

        // get previous balance of debit account before transaction and update after transaction
        $query = "UPDATE `account_list` SET `balance` = '$to_balance_1' WHERE acc_id = $to_acc;";
        $result = $mysqli->query($query);

        // instert this transaction as a debit set into trans_list (It can be seen by manager)
        $query = "INSERT INTO trans_list(trans_date0,from_bank, from_bsb, from_user, from_acc, to_bank, to_bsb, to_user, to_acc, debit, credit, purpose, balance,amount_0, currency, exc_rate) 
        VALUES ('$date','$bank','$BSB','$to_user','$to_acc','$bank','$BSB','$username','$from_acc','$amount_1',0,'$purpose','$to_balance_1','$amount','$currency','$exc_rate')";
        $result = $mysqli->query($query);
        $to_trans_id = mysqli_insert_id($mysqli);

        //sent a message to debit user
        $to_message = "You have resived " . $currency ."". $amount . " from " . $username . " (" . $from_acc . ").";
        $query = "INSERT INTO `message_list`( `username` , `from_username`, `message`) 
        VALUES ('$to_user','Systerm','$to_message')";
        $result = $mysqli->query($query);
        // This is just some test:
        // echo $from_trans_id;
        // echo "<br />";
        // echo $from_acc;
        // echo "<br />";
        // echo $to_user;
        // echo "<br />";
        // echo $to_acc;
        // echo "<br />";
        // echo $amount;
        // echo "<br />";
        // echo $purpose;
        // echo "<br />";
        // echo $to_trans_id;
        // echo "<br />";
        // }

?>