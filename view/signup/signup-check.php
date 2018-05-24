<?php
session_start();
$_SESSION["error"]="1";

$servername = "localhost";
$username = "sconverter@localhost";
$db = "my_sconverter";
$password = "";

$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO utenti (utente, password, path)
VALUES ('".$_POST['uname']."', '".$_POST['psw']."', 'help.png')";


if($conn->query($sql) == TRUE) 
{
    echo "New record created successfully";
    
    header('Location: ../../index.php');
} 
else
{
    
    
    
   
    echo "<script>alert('Utente già registrato'); window.location = 'signup-view.php';</script>";
   
    
    
    
}

$conn->close();
?>