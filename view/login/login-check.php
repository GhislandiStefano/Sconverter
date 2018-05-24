<html>
<?php
session_start();

?>
<?php
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
    $sql = "SELECT utente, password FROM utenti where utente='".$_POST['uname']."'";
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) 
       {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          
            
            /*echo "username: ". $row['utente'] ." password: ".$row['password'];*/
            if($_POST["uname"] == $row['utente'] && $_POST["psw"] == $row['password'])
            {
            
                 $_SESSION["utente"] = $_POST['uname'];
                header('Location: ../../index.php');
            }
            else
            echo "<script>alert('Utente non esistente'); window.location = 'login-view.php';</script>";
       }
       
        
    } else {

        echo "<script>alert('Utente non esistente'); window.location = 'login-view.php';</script>";
    }
    
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
</html>