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
$username = $_POST['object']['username'];
$password = $_POST['object']['password'];

//Getting username and password from database
$sql = "SELECT ID, Username, Password FROM user_inf WHERE Username = '$username'";

$result = $conn->query($sql);

//Check if username is okay
if ($result->num_rows > 0) {
    //If username is okay
    while($row = $result->fetch_assoc()) {
        $id = $row['ID'];
        $user = $row['Username'];
        $hash = $row['Password'];
            //Check if password is okay
        if(password_verify($password, $hash)){
            echo '1';
        }else{
             echo '0';
        };
    }
} else {
    echo '3';
}
//close the connection
$conn -> close();
?>