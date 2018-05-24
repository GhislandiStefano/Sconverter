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


$sql = "DELETE FROM api WHERE titolo='".$_POST['elimina']."'";
if($conn->query($sql) == TRUE) 
{
   $_SESSION['risposta']=2;

   
} 
else
{
   
    
   
    
    echo "Error: " . $sql . "<br>" . $conn->error;
    
}

$conn->close();
?>