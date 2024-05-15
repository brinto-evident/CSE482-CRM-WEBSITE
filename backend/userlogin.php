<?php
require_once('dbconnetion.php');

$email = $_GET['email'];
$pass = $_GET['pass'];
$logincheck = $_GET['logincheck'];

$sql = "SELECT UserID, Name, Email FROM usertable WHERE email='$email' AND password = '$pass'";
$response = mysqli_query($conn, $sql);

if(mysqli_num_rows($response)!=0){
    $result = mysqli_fetch_assoc($response);
    session_start();
    $_SESSION['userid'] = $result['UserID'];
    $_SESSION['name'] = $result['Name'];
    $_SESSION['email'] = $result['Email'];
    if($logincheck == 'true'){
        $_SESSION['loggedin'] = 1;
    }else{
        $_SESSION['loggedin'] = 0;
    }

    print_r($_SESSION);

}else{
    echo "error";
}

mysqli_close($conn);