<?php
// Start the session
session_start();
$_SESSION["path"];

?>
<?php
require '../../templates/header.php';

// Set session variables
if(!$_SESSION["utente"])
   {
   $_SESSION["cerca"]="";
    header('Location: login.php');
  }
else{
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
    $sql = "SELECT utente,path,id_utente FROM utenti WHERE id_utente='".$_GET['id']."'";
    $result = $conn->query($sql);
   
    
    if ($result->num_rows > 0) 
       {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          
            
            $p['utente']=$row['utente'];
            $p['path']=$row['path'];
            $p['id_utente']=$row['id_utente'];
 
       }
       
        
    } 
    
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

$_SESSION['id_utente']=$p['id_utente'];

?>

<?php

try 
{
	$conn = mysqli_connect($servername, $username, $password, $db);
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id_utente FROM utenti WHERE utente='".$_SESSION['utente']."'";
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) 
       {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          
            
            $r['id']=$row['id_utente'];
            

       }
    }
    
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

<?php

$_SESSION['id']=$r['id'];
try 
{   
    $f=0;
    $z=0;
	$conn = mysqli_connect($servername, $username, $password, $db);
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT utente1,utente2,richiesta FROM amici WHERE utente1='".$r['id']."' and utente2='".$_GET['id']."'";
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) 
       {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          
            
           if($row['utente1']==$r['id'] && $row['utente2']==$_GET['id'])
           {
               $f=1;
               if($row['richiesta']==1)
               {
                $z++;
               }
           }

       }
    } 
    
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>


<?php


try 
{   
   
    $b=0;
	$conn = mysqli_connect($servername, $username, $password, $db);
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT utente1,utente2,richiesta FROM amici WHERE utente1='".$_GET['id']."' and utente2='".$r['id']."'";
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) 
       {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          
            
          if($row['utente1']==$_GET['id'] && $row['utente2']==$r['id'])
           {
               $b=1;
               if($row['richiesta']==1)
               {
               $z++;
               }
           }

       }
    } 
    
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

<div class="d-flex justify-content-center w-100 h-100">
	<div class="align-self-center jumbotron">
    <a onclick="javascript:window.close()" class="btn btn-danger mt-1">Indietro</a>
		<h1 class="mb-3"><?php echo $p['utente'];?></h1>
			<div class="d-flex flex-column">
			<img src="<?php echo "../../uploads/". $p['path'];?>" alt="Smiley face" class="img-thumbnail p-2" style="border: 2px solid black; height: 200px; width:140px;">
           
            <?php
               
               if($f==0 && $b==0){
            
            ?>  
            <form action="friends-request.php" method="post" name="request">
            <input type="submit" value="Invia amicizia" name="submit" class="btn btn-success mt-1">
            </form>
            <?php }else
               if($z>0){ ?>
              <input type="submit" value="Amici" name="submit" class="btn btn-success mt-1">
              <?php }else  ?>

            
            <?php if($z==0){
            if($f==1){ ?>
              <input type="submit" value="Richiesta inviata" name="submit" class="btn btn-success mt-1">
              <?php }
              if($b==1){ ?>
              <input type="submit" value="Richiesta ricevuta da <?php echo $p['utente']; ?> " name="submit" class="btn btn-success mt-1">
              <?php }
              
              }  ?>
                         
        </div>
    </div>
</div> 


<?php } ?>
<?php require '../../templates/footer.php'; ?>
                
             