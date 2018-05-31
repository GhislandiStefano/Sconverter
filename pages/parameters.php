<?php

          
          session_start();
 		  $servername = "localhost";
          $username = "sconverter@localhost";
          $db = "my_sconverter";
          $password = "";
          try{
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
                $r=$row['id_utente'];
                
              }
            }
          }
          catch(PDOException $e)
          {
            echo $sql . "<br>" . $e->getMessage();
          }
          
          try{
            
            $sql = "SELECT COUNT(id_amici) as c
					FROM amici
					WHERE utente1='".$r."' or utente2='".$r['id']."' and richiesta='1'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $a=$row['c'];
                
              }
            }
          }
          catch(PDOException $e)
          {
            echo $sql . "<br>" . $e->getMessage();
          }
          try{
            
            $sql = "SELECT COUNT(id_amici) as c
					FROM amici
					WHERE utente1='".$r."' and richiesta='0'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $f=$row['c'];
                
              }
            }
          }
          catch(PDOException $e)
          {
            echo $sql . "<br>" . $e->getMessage();
          }
          
          try{
            
            $sql = "SELECT COUNT(id_amici) as c
					FROM amici
					WHERE utente1='".$r."' or utente2='".$r['id']."' and richiesta='1'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $a=$row['c'];
                $_SESSION["amici"]=$a;
                
              }
            }
          }
          catch(PDOException $e)
          {
            echo $sql . "<br>" . $e->getMessage();
          }
          try{
            
            $sql = "SELECT COUNT(id_amici) as c
					FROM amici
					WHERE utente2='".$r."' and richiesta='0'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $z=$row['c'];
                
              }
            }
          }
          catch(PDOException $e)
          {
            echo $sql . "<br>" . $e->getMessage();
          }
          
          
          mysqli_close($con);
          
           $return_arr = array("inviate" => $f,"amici" => $a,"ricevute" => $z);
               
          header('Content-Type: application/json');
          echo json_encode($return_arr); 
          
?>          