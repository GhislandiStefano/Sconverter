<?php
session_start();

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


$sql = " INSERT INTO api (titolo)
VALUES ('".$_POST['aggiungi']."')";
if($conn->query($sql) == TRUE) 
{
   $_SESSION['risposta']=1;

   
} 
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
    
}
$conn->close();
?>