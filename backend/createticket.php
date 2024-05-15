<?php
require_once('dbconnetion.php');
session_start();
date_default_timezone_set("Asia/Dhaka");
$ticketid = rand(pow(10, 11 - 1), pow(10, 11) - 1);
$subject = $_POST['subject'];
$userid = $_SESSION['userid'];
$systemid = $_POST['systemid'];
$supporttype = $_POST['supporttype'];
$urgency = $_POST['urgency'];
$details = $_POST['details'];
$date = date('Y-m-d h:i:s');
$status = 'issued';

if (isset($subject, $supporttype, $urgency, $details)) {
    $sql = "INSERT INTO ticketdetails VALUES ($ticketid, '$subject',$userid, $systemid, '$supporttype', '$urgency', '$details', '$date', '$status')";
    if(mysqli_query($conn, $sql)){
        echo "success";
    }else{
        echo "error";
    }
}
else{
    echo "error";
}



mysqli_close($conn);
