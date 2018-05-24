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

try 
{
    $sql = "SELECT titolo FROM api";
    $result = $conn->query($sql);
    
    $i=0;
    if ($result->num_rows > 0) 
       {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
          
        $array["titolo".$i]=$row["titolo"];
        $i++;
    }
    
    }
    
}
catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}

echo json_encode($array);

$conn->close();
?>