<!doctype html>
<html lang="en" style="overflow-x: hidden;">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <title>Sconverter</title>
  </head>
  <body>
    <?php
          session_start();

		  $servername = "localhost";
          $username = "sconverter@localhost";
          $db = "my_sconverter";
          $password = "";
          $n=0;
          $k=0;
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
                $r['id']=$row['id_utente'];
              }
            }
          }
          catch(PDOException $e)
          {
            echo $sql . "<br>" . $e->getMessage();
          }
          try
          {
            $conn = mysqli_connect($servername, $username, $password, $db);
            if ($conn->connect_error)
            {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT utente2 FROM amici WHERE utente1='".$r['id']."' AND richiesta='1'";
            $result = $conn->query($sql);
            $contatore_id_richiesta=0; //contatore per id richiesta
            //metto nell'arrey id utente amico
            if ($result->num_rows > 0)
            {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $id_richiesta["i".$contatore_id_richiesta]=$row['utente2'];
                $contatore_id_richiesta++;
              }
              $contatore_id_richiesta=0; //azzero contatore
            }
          }
          catch(PDOException $e)
          {
            echo $sql . "<br>" . $e->getMessage();
          }
          ?>
          <div class="container p-2 m-3" style="box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);">
          	<div class="row text-muted">
            <?php
            while($contatore_id_richiesta<count($id_richiesta)){
              $sql="SELECT utente,path FROM utenti WHERE id_utente='".$id_richiesta["i".$contatore_id_richiesta]."'"; //sleziona nome utente dove gli id corrispondono
              if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $utente2["i".$contatore_id_richiesta]=$row['utente']; //array per le richieste
                  $r["i".$contatore_id_richiesta]=$row['path'];
                }
              }
              ?>
              <div class="col-md-3">
                <div class="card mt-5" style="width:12rem">
                  <div class="card-header font-weight-bold">
                  <div style="position:relative;overflow: hidden;width:150px;height:150px;">
                  <img src="../uploads/<?echo $r["i".$contatore_id_richiesta];?>" alt="profile" align="middle" style="position: relative;margin: auto;min-width:100%;height:100%;">
                  </div>
                  </div>
                  <div class="card-body">
                    <a target="_blank" href="../view/friends/profile.php?id=<?php echo $id_richiesta["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                      <div class="text-center w-100">
                        <h6 style='align:center!important;color:black;'><?php echo $utente2["i".$contatore_id_richiesta];?></h6>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <?php
              $contatore_id_richiesta++;
            }
            if(count($id_richiesta) === '0'){
              $n++;
            }
            $contatore_id_richiesta=0;
            try
            {
              $conn = mysqli_connect($servername, $username, $password, $db);
              if ($conn->connect_error)
              {
                die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT utente1 FROM amici WHERE utente2='".$r['id']."' AND richiesta='1'";
              $result = $conn->query($sql);
              $contatore_id_richiesta=0; //contatore per id richiesta
              //metto nell'arrey id utente amico
              if ($result->num_rows > 0)
              {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  $id_richiesta1["i".$contatore_id_richiesta]=$row['utente1'];
                  $contatore_id_richiesta++;
                }
                $contatore_id_richiesta=0; //azzero contatore
              }
            }
            catch(PDOException $e)
            {
              echo $sql . "<br>" . $e->getMessage();
            }
            while($contatore_id_richiesta<count($id_richiesta1)){
              $sql="SELECT utente,path FROM utenti WHERE id_utente='".$id_richiesta1["i".$contatore_id_richiesta]."'"; //sleziona nome utente dove gli id corrispondono
              if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                  
                  $utente1["i".$contatore_id_richiesta]=$row['utente']; //array per le richieste
                  $o["i".$contatore_id_richiesta]=$row['path'];
                }
              }
              ?>
              <div class="col-md-3">
                <div class="card mt-5" style="width:12rem">
                  <div class="card-header font-weight-bold">
                  <div style="position:relative;overflow: hidden;width:150px;height:150px;">
                  <img src="../uploads/<?echo $o["i".$contatore_id_richiesta];?>" alt="profile" align="middle"  style="position: relative;margin: auto;min-width:100%;height:100%;">
                  </div>
                  </div>
                  <div class="card-body">
                    <a target="_blank" href="../view/friends/profile.php?id=<?php echo $id_richiesta1["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                      <div class="text-center w-100">
                        <h6 style='align:center!important;color:black;'><?php echo $utente1["i".$contatore_id_richiesta];?></h6>
                      </div>
                    </a>
                  </div>
                </div>
              </div>





              <?php	$contatore_id_richiesta++; }

              if($n>0){ ?>
                <h5 align="center" class="mb-2">Non hai ancora nessun amico</h5>
                <?php $k++; ?>

              <?php } ?>
              <?php if(count($id_richiesta1)==0 ){ ?>
                <?php if($k==0){ ?>
                  <h5 align="center" class="mb-2">Non hai ancora nessun amico</h5>

                <?php } ?>
              <?php } $contatore_id_richiesta=0; ?>


              <?php
              $conn = null;

              ?>
        </div>
     </body>
   </html>     