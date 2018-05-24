<?php
session_start();

$servername = "localhost";
$username = "sconverter@localhost";
$USERNAME = "step";
$PASSWORD = "99";
$db = "my_sconverter";
$password = "";

$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO amici (utente1, utente2, richiesta)
VALUES ('".$_SESSION['id']."', '".$_SESSION['id_utente']."', '0')";
echo $_SESSION['id'];
echo $_z['id'];


if($conn->query($sql) == TRUE) 
{
   echo "<script>alert('Richiesta inviata'); window.location = '../../index.php';</script>";

   
} 
else
{
   
    echo "<script>alert('Errore'); window.location = '../../index.php';</script>";
   
    
    echo "Error: " . $sql . "<br>" . $conn->error;
    
}

$conn->close();
?>