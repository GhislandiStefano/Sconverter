<?php
session_start(); //avvia la sessione
// *********** TEMPLATES ***********
require './templates/header.php'; //template header

// test sulla sessione, assegnamento variabili
if(!$_SESSION["utente"]){
  header('Location: ./view/login/login-view.php'); //se non esiste la sessione allora login
} else {
  $servername = "localhost";
  $username = "sconverter@localhost";
  $db = "my_sconverter";
  $password = "";
  try {
    $conn = mysqli_connect($servername, $username, $password, $db); //connetti al database
    //se errore
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error); //connessione fallita
    }
    $sql = "SELECT path FROM utenti WHERE utente='".$_SESSION["utente"]."'"; //sleziona il path dell'immagine
    $result = $conn->query($sql);
    //se sono presenti risultati
    if ($result->num_rows > 0) {
      // ciclo per assegnare il path immagine alla session
      while($row = $result->fetch_assoc()) {
        $_SESSION["path"] = $row['path'];
      }
    } else {
      echo "0 results"; //se non ci sono risultati stampo
    }
  }	catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage(); //errore sulla query
  }
  ?>
  <html class="w-100 h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UTENTI</title>
  </head>
  <body class="w-100 h-100">
    <div class="d-flex justify-content-center flex-column w-100 h-100 p-4">
      <h1 class="mb-3"><?php echo "Benvenuto ". $_SESSION["utente"].  "!"; }?></h1>

      <div class="d-flex flex-column">
        <img src="<?php echo "./uploads/". $_SESSION["path"];?>" alt="Smiley face" class="img-thumbnail p-2" style="border: 2px solid black; height: 480px; width:360px;">
        <div class="p-2">
          <form action="./view/upload/upload-images.php" method="post" enctype="multipart/form-data">
            <a href="./view/login/logout.php" class="btn btn-danger mt-1">Esci</a>
            <input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-secondary mt-1">
            <input type="submit" value="Carica" name="submit" class="btn btn-success mt-1">
          </form>
        </div>
        <div class="p-2 jumbotron bg-white mt-4">
          <h2 class="mb-2">Modifica password</h2>
          <form action="./view/login/update-password.php" method="post" enctype="multipart/form-data">
            <input type="password" name="passwordVecchia" class="form-control mb-0" style="border-bottom-right-radius: 0; border-bottom-left-radius: 0; " placeholder="Vecchia Password">
            <input type="password" name="passwordNuova" class="form-control mt-0" style="border-top-left-radius: 0; border-top-right-radius: 0;" placeholder="Nuova Password">
            <input type="submit" value="Aggiorna" name="submit" class="btn btn-success mt-1">
          </form>
        </div>
        <div class="p-2 jumbotron bg-white mt-4">
          <h2 class="mb-2">Amici</h2>
          <form action="index.php" method="post" name="richieste">
            <input type="submit" value="Apri" name="amici" class="btn btn-success mt-1">
          </form>
        </div>
        <?php
        if(isset($_REQUEST['amici'])){
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
            <?php
            while($contatore_id_richiesta<count($id_richiesta)){
              $sql="SELECT utente FROM utenti WHERE id_utente='".$id_richiesta["i".$contatore_id_richiesta]."'"; //sleziona nome utente dove gli id corrispondono
              if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $utente2["i".$contatore_id_richiesta]=$row['utente']; //array per le richieste
                }
              }
              ?>
              <div class="row text-muted">
                <div class="col">
                  <a target="_blank" href="./view/friends/profile.php?id=<?php echo $id_richiesta["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                    <div class="d-flex justify-content-between align-items-center w-100">
                      <p>
                        <small class="d-block"><?php echo $utente2["i".$contatore_id_richiesta];?></small>
                      </p>
                    </div>
                  </a>
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
              $sql="SELECT utente FROM utenti WHERE id_utente='".$id_richiesta1["i".$contatore_id_richiesta]."'"; //sleziona nome utente dove gli id corrispondono
              if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $utente1["i".$contatore_id_richiesta]=$row['utente']; //array per le richieste
                }
              }
              ?>
              <div class="row text-muted">
                <div class="col">
                  <a target="_blank" href="./view/friends/profile.php?id=<?php echo $id_richiesta1["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                    <div class="d-flex justify-content-between align-items-center w-100">
                      <p>
                        <small class="d-block"><?php echo $utente1["i".$contatore_id_richiesta];?></small>
                      </p>
                    </div>
                  </a>
                </div>
              </div>





              <?php	$contatore_id_richiesta++; }

              if($n>0){ ?>
                <h5 class="mb-2">Non hai ancora nessun amico</h5>
                <?php $k++; ?>

              <?php } ?>
              <?php if(count($id_richiesta1)==0 ){ ?>
                <?php if($k==0){ ?>
                  <h5 class="mb-2">Non hai ancora nessun amico</h5>

                <?php } ?>
              <?php } $contatore_id_richiesta=0; ?>


              <?php
              $conn = null;

              ?>
            <?php } ?>



            <div class="p-2 jumbotron bg-white mt-4">
              <h2 class="mb-2">Richieste Inviate</h2>
              <form action="index.php" method="post" name="richieste">
                <input type="submit" value="Apri" name="richieste" class="btn btn-success mt-1">
              </form>
            </div>

            <?php
            //test sulle richieste inviate
            if(isset($_REQUEST['richieste'])){
              //se la connessione ha errori
              if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit(); //termino
              }
              $sql="SELECT id_utente FROM utenti WHERE utente='".$_SESSION['utente']."'"; //selezione id utente che ha nome utente uguale alla sessione
              $result = mysqli_query($conn, $sql);
              if ($result->num_rows > 0) {
                // ciclo per assegnare il l'utente alla session
                while($row = $result->fetch_assoc()) {
                  $_SESSION['id_richiesta']=$row['id_utente'];
                }
              } else {
                echo "0 results"; //se non ci sono risultati stampo
              }
              $sql="SELECT utente2 FROM amici WHERE utente1='".$_SESSION['id_richiesta']."' AND richiesta='0' "; //selezione tutti utenti legati a utente loggato
              if ($result = mysqli_query($conn, $sql)) {
                $contatore_id_richiesta=0; //contatore per id richiesta
                //metto nell'arrey id utente amico
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_richiesta["i".$contatore_id_richiesta]=$row['utente2'];
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
                      $utente2["i".$contatore_id_richiesta]=$row['utente']; //array per le richieste
                    }
                  }
                  ?>
                  <div class="row text-muted">
                    <div class="col">
                      <a target="_blank" href="./view/friends/profile.php?id=<?php echo $id_richiesta["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                        <div class="d-flex justify-content-between align-items-center w-100">
                          <p>
                            <small class="d-block"><?php echo $utente2["i".$contatore_id_richiesta];?></small>
                          </p>
                        </div>
                      </a>
                    </div>
                  </div>


                  <?php
                  $contatore_id_richiesta++;
                }
                if(!isset($utente2)){
                  ?>
                  <h5 class="mb-2">Nessuna richiesta effettuata</h5>
                <?php } $contatore_id_richiesta=0; } ?>
                <div class="p-2 jumbotron bg-white mt-4">
                  <h2 class="mb-2">Richieste ricevute</h2>
                  <form action="index.php" method="post" name="richieste">
                    <input type="submit" value="Apri" name="ricevute" class="btn btn-success mt-1">
                  </form>
                </div>
                <?php
                //test sulle richieste ricevute
                if(isset($_REQUEST['ricevute'])){
                  //se la connessione ha errori
                  if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit(); //termino
                  }
                  $sql="SELECT id_utente FROM utenti WHERE utente='".$_SESSION['utente']."'"; //selezione id utente che ha nome utente uguale alla sessione
                  $result = mysqli_query($conn, $sql);
                  if ($result->num_rows > 0) {
                    // ciclo per assegnare il l'utente alla session
                    while($row = $result->fetch_assoc()) {
                      $_SESSION['id_richiesta']=$row['id_utente'];
                    }
                  } else {
                    echo "0 results"; //se non ci sono risultati stampo
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
                            <a target="_blank" href="./view/friends/profile.php?id=<?php echo $id_richiesta["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                              <div class="d-flex justify-content-between align-items-center w-100">
                                <p>
                                  <small class="d-block"><?php echo $utente1["i".$contatore_id_richiesta];?>
                                  </small>
                                </p>
                              </div>
                            </a>
                            <a href="./view/friends/accept-friends.php?id=<?php echo $id_richiesta["i".$contatore_id_richiesta]; ?>" class="media pt-3" style="text-decoration: none;">
                              <input type="button" value="accetta" name="accetta" class="btn btn-success mt-1">
                            </a>
                          </div>
                        </div>
                      <?php } ?>
                      <?php	$contatore_id_richiesta++; }
                      if(!isset($utente1)){ ?>

                        <h5 class="mb-2">Nessuna richiesta ricevuta</h5>


                      <?php } $contatore_id_richiesta=0; } ?>

                      <div class="p-2 jumbotron bg-white mt-4">
                        <h2 class="mb-2">Ricerca Utente</h2>
                        <form action="index.php" method="post" name="cerca">
                          <input name="s" class="form-control mb-0" style="border-bottom-right-radius: 0; border-bottom-left-radius: 0; " placeholder="Cerca utente">
                          <input type="submit" value="cerca" name="submit" class="btn btn-success mt-1">
                        </form>
                      </div>
                      <?php
                      //test sulla ricerca utenti
                      if(isset($_REQUEST['submit'])){
                        $_SESSION['id']=$_REQUEST["s"];
                        $sql="SELECT utente,path,id_utente FROM utenti WHERE utente LIKE '".$_REQUEST["s"]."%'";
                        if ($result = mysqli_query($conn, $sql)) {
                          $i=0;
                          //ciclo per salvare
                          while ($row = mysqli_fetch_assoc($result)) {
                            //disgustoso, però funzia
                            $t["name".$i]=$row['utente'];
                            $r["p".$i]=$row['path'];
                            $id["i".$i]=$row['id_utente'];
                            $i++;
                            $f=$i;
                          }
                          $i=0;	?>

                          <h1 class="mb-2">Utenti trovati:</h1>
                          <?php while($i<$f){?>
                            <div class="container p-2 m-3" style="box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);">
                              <div class="row text-muted">
                                <div class="col">
                                  <a target="_blank" href="./view/friends/profile.php?id=<?php echo $id["i".$i]; ?>" class="media pt-3" style="text-decoration: none;">
                                    <img src="./uploads/<?echo $r["p".$i];?>" alt="img" class="mr-2 rounded" style="width: 32px; height: 32px;">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                      <p>
                                        <small class="d-block"><?php echo $t['name'.$i];?></small>
                                      </p>
                                    </div>
                                  </a>

                                </div>
                              </div>
                            </div>
                            <?php	$i++; } ?>
                          </div>
                        </div>
                      </div>
                      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                    </body>
                    </html>
                    <?php
                    mysqli_free_result($result); }
                    mysqli_close($conn); }
                    ?>
                    <?php require './templates/footer.php';?>
