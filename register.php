<?php

header('Access-Control-Allow-Origin: *');

//Database information
//host
$dbhost = 'localhost';
//username
$dbuser = 'root';
//password
$dbpass = '123456';
//database name
$db = 'test';

//Connection to the database
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die('Connect failed: %s\n'. $conn -> error);

//Getting the object sent from JavaScript
$_POST['object'];

//Using the values
$email = $_POST['object']['email'];
$username = $_POST['object']['username'];
$password = $_POST['object']['password'];

//Hashing the password
$hashpass = password_hash($password, PASSWORD_DEFAULT);

//Getting all usernames and passwords from database
$checkUsername = "SELECT Username FROM user_inf WHERE Username = '$username' OR Email = '$email'";

$resultsUsername = $conn->query($checkUsername);

//Check if username already exists
if ($resultsUsername->num_rows > 0) {

    $conn -> close();

    echo 0;

}else{
    //If it dosen't send it to database
    $sql = "INSERT INTO user_inf (Username, Password, Email)
    VALUES ('$username', '$hashpass', '$email')";
    
    $result = $conn->query($sql);
    
    $conn -> close();
    
    echo 1;
    
};


?>