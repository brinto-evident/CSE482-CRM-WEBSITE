<?php
require_once('dbconnetion.php');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$name = $firstname . " " . $lastname;
$email = $_POST['email'];
$pass = $_POST['pass'];
$confpass = $_POST['confpass'];
$hash_pass = "";


if ($pass == $confpass && isvalidPassword($pass)) {
    // $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
    while (true) {

        try {
            $userID = rand(pow(10, 11 - 1), pow(10, 11) - 1);
    
            $sql = "SELECT COUNT(*) AS result FROM usertable WHERE userID = $userID";
            $response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
            if ($response['result'] == 0) {
                $sqlquery = "INSERT INTO usertable (userID,Name,Email,password) VALUES ($userID, '$name', '$email', '$pass')";
                if (mysqli_query($conn, $sqlquery)) {
                    echo "Registration Successful";
                    break;
                } else {
                    echo "Fatal Error! Try Again";
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
} else {
    throw new Exception("Passwords don not match or password is invalid", 1);
}



mysqli_close($conn);


function isvalidPassword($pass)
{
    if (strlen($pass) >= 8 && strlen($pass) <= 255) {
        if (preg_match('/[A-Z]+/', $pass) && preg_match('/[a-z]+/', $pass) && preg_match('/[\d!$%^&]+/', $pass)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
