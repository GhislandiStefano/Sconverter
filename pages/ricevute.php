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

<?php
                
                session_start();

                $servername = "localhost";
                $username = "sconverter@localhost";
                $db = "my_sconverter";
                $password = "";
                
                $conn = mysqli_connect($servername, $username, $password, $db);			
            
                  $sql="SELECT id_utente FROM utenti WHERE utente='".$_SESSION['utente']."'"; //selezione id utente che ha nome utente uguale alla sessione
                  $result = mysqli_query($conn, $sql);
                  if ($result->num_rows > 0) {
                    // ciclo per assegnare il l'utente alla session
                    while($row = $result->fetch_assoc()) {
                      $_SESSION['id_richiesta']=$row['id_utente'];
                    }
                  } else {
                    
                  }
                  $sql="SELECT id_utente FROM utenti WHERE utente='".$_SESSION['utente']."'"; //selezione id utente che ha nome utente uguale alla sessione
                  $result = mysqli_query($conn, $sql);
                  if ($result->num_rows > 0) {
                    // ciclo per assegnare il l'utente alla session
                    while($row = $result->fetch_assoc()) {
                      $_SESSION['id_richiesta']=$row['id_utente'];
                    }
                  }
                  $sql="SELECT utente1 FROM amici WHERE utente2='".$_SESSION['id_richiesta']."' AND richiesta='0'"; //selezione tutti utenti legati a utente loggato
                  if ($result = mysqli_query($conn, $sql)) {
                    $contatore_id_richiesta=0; //contatore per id richiesta
                    //metto nell'arrey id utente amico
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id_richiesta["i".$contatore_id_richiesta]=$row['utente1'];
                      $contatore_id_richiesta++;
                    }
                    $contatore_id_richiesta=0; //azzero contatore
                  }
                  ?>

                  <div class="container p-2 m-3" style="box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);">
                    <?php
                    //gestione stampa richieste
                    while($contatore_id_richiesta<count($id_richiesta)){
                      $sql="SELECT utente FROM utenti WHERE id_utente='".$id_richiesta["i".$contatore_id_richiesta]."'"; //sleziona nome utente dove gli id corrispondono
                      if ($result = mysqli_query($conn, $sql)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          $utente1["i".$contatore_id_richiesta]=$row['utente']; //array per le richieste
                        }
                      }
                      ?>
                      <?php if(isset($utente1["i".$contatore_id_richiesta])){ ?>
                        <div class="row text-muted">
                          <div class="col">
                          <div class="card" style="width:15rem">
                            <div class="card-header font-weight-bold">
                            <a target="_blank" href="../view/friends/profile.php?id=<?php echo $id_richiesta["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                              <div class="d-flex justify-content-between align-items-center w-100">
                                <p>
                                  <small class="d-block"><?php echo $utente1["i".$contatore_id_richiesta];?>
                                  </small>
                                </p>
                              </div>
                            </a>
                            </div>
                            <div class="card-body">
                               <a href="../view/friends/accept-friends.php?id=<?php echo $id_richiesta["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                              <input type="button" value="accetta" name="accetta" class="btn btn-success mt-1">
                            </a>
                            </div>
                          </div>
                          </div>
                        </div>
                      <?php } ?>
                      <?php	$contatore_id_richiesta++; }
                      if(!isset($utente1)){ ?>

                        <h5 align="center" class="mb-2">Nessuna richiesta ricevuta</h5>


                      <?php } $contatore_id_richiesta=0;?>