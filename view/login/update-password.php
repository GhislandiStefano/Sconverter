<?php
// Start the session
session_start();
$_SESSION["path"];

?>
<?php

// Set session variables
if(!$_SESSION["utente"])
   {
   $_SESSION["cerca"]="";
    header('Location: login.php');
  }
else {
?>
<?php
session_start();
$_SESSION["utente"];
$servername = "localhost";
$username = "sconverter@localhost";
$db = "my_sconverter";
$password = "";

try 
{
	$conn = mysqli_connect($servername, $username, $password, $db);
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT password FROM utenti WHERE utente='".$_SESSION["utente"]."'";
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) 
       {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          
            
            /*echo "username: ". $row['utente'] ." password: ".$row['password'];*/
            if($_POST["passwordVecchia"] == $row['password'])
            {
                
              
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

                echo $_FILES["name"];
                $sql = "UPDATE utenti SET password='".$_POST["passwordNuova"]."' WHERE utente='".$_SESSION["utente"]."'";

                if($conn->query($sql) == TRUE) 
                {
                    echo "New record created successfully";
                    header('Location: ../../index.php');



                } 
                else
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
            else
            echo "<script>alert('Password vecchia errata!'); window.location = 'index0.php';</script>";
       }
     
    } else {

        echo "0 results";
        
    }
    
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}
?>