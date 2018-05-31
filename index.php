<script>

window.setInterval(function(){
       /// call your function here
      numbers();
}, 1000);
function numbers(){
       
       
       xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                
                var data = JSON.parse(this.response);
                
                document.getElementById("amici").innerHTML = data.amici;
                document.getElementById("inviate").innerHTML = data.inviate;
                document.getElementById("ricevute").innerHTML = data.ricevute;
           
            }
        };
        xmlhttp.open("GET","/pages/parameters.php", true);
        xmlhttp.send();
      
    }
    
    function amici(){
       
 
        
      document.getElementById("0").innerHTML='<li id="1" class="nav-item"><a class="nav-link active " onclick="amici()" href="#">Amici</a></li><li id="2" class="nav-item"><a class="nav-link disabled " onclick="inviate()" href="#">Richieste inviate</a></li><li id="3" class="nav-item"><a class="nav-link disabled " onclick="ricevute()" href="#">Richieste ricevute</a></li><li id="3" class="nav-item"><a class="nav-link disabled " onclick="ricerca()" href="#">Ricerca</a></li>';
       
   
     document.getElementById("card").innerHTML = '<iframe src="/ajax/amici.php" width="1200" height="500" frameborder="0" scrolling="yes"></iframe>';
     
           
      
      
    }
    
    function inviate()
    {
    
       document.getElementById("0").innerHTML='<li id="1" class="nav-item"><a class="nav-link disabled " onclick="amici()" href="#">Amici</a></li><li id="2" class="nav-item"><a class="nav-link active " onclick="inviate()" href="#">Richieste inviate</a></li><li id="3" class="nav-item"><a class="nav-link disabled " onclick="ricevute()" href="#">Richieste ricevute</a></li><li id="3" class="nav-item"><a class="nav-link disabled " onclick="ricerca()" href="#">Ricerca</a></li>';
       document.getElementById("card").innerHTML = '<iframe src="/ajax/inviate.php" width="1200" height="500" frameborder="0" scrolling="yes"></iframe>';
    
    
    }
    
    function ricevute()
    {
    
       document.getElementById("0").innerHTML='<li id="1" class="nav-item"><a class="nav-link disabled " onclick="amici()" href="#">Amici</a></li><li id="2" class="nav-item"><a class="nav-link disabled " onclick="inviate()" href="#">Richieste inviate</a></li><li id="3" class="nav-item"><a class="nav-link active " onclick="ricevute()" href="#">Richieste ricevute</a></li><li id="3" class="nav-item"><a class="nav-link disabled " onclick="ricerca()" href="#">Ricerca</a></li>';
       document.getElementById("card").innerHTML = '<iframe src="/ajax/ricevute.php" width="1200" height="500" frameborder="0" scrolling="yes"></iframe>';
    
    
    }
    
    function converti()
    {
       
       document.getElementById("0").innerHTML='<li id="1" class="nav-item"><a class="nav-link active" href="#">Convert</a></li><li id="2" class="nav-item"><a class="nav-link disabled " href="share.php">Share</a></li><li id="3" class="nav-item"><a class="nav-link disabled" href="reconvert.php">Reconvert</a></li>';
       document.getElementById("card").innerHTML = '<iframe src="/ajax/iviate.php" width="1200" height="500" frameborder="0" scrolling="yes"></iframe>';
    
    
    }
    
    function ricerca()
    {
    
       document.getElementById("0").innerHTML='<li id="1" class="nav-item"><a class="nav-link disabled " onclick="amici()" href="#">Amici</a></li><li id="2" class="nav-item"><a class="nav-link disabled " onclick="inviate()" href="#">Richieste inviate</a></li><li id="3" class="nav-item"><a class="nav-link disabled " onclick="ricevute()" href="#">Richieste ricevute</a></li><li id="3" class="nav-item"><a class="nav-link active " onclick="ricerca()" href="#">Ricerca</a></li>';
       document.getElementById("card").innerHTML = '<iframe src="/ajax/ricerca.php" width="1200" height="500" frameborder="0" scrolling="yes"></iframe>';
    
    
    }
    
    
</script>
<?php
session_start(); //avvia la sessione
// *********** TEMPLATES ***********
//require './templates/header.php'; //template header

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

<!doctype html>
<html lang="en" style="overflow-x: hidden;">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <title>Sconverter</title>
    <script>
      function NomeFile(){
        var nome = document.getElementById('userfile').value.split( '\\' ).pop();
        document.getElementById('qualeFile').innerHTML = "<a class='btn btn-dark text-white btn-sm mt-2' style='border-top-left-radius: 0px; border-bottom-left-radius: 0px;''>"+nome+"</a>";
      }
      
      function load(){
        document.body.addEventListener("wheel", zoomShortcut); //add the event
      }
      
      function toggleZoomScreen() {
		document.body.style.zoom="100%";
	} 

      function zoomShortcut(e){
        if(e.ctrlKey){            //[ctrl] pressed?
          event.preventDefault();  //prevent zoom
          if(e.deltaY<0){        //scrolling up?
                                  //do something..
            return false;
          }
          
          if(e.deltaY>0){        //scrolling down?
                                  //do something..
            return false;
          }
          
      }
    }  
    </script>
  </head>
  <body onload="load();numbers();toggleZoomScreen()" style="background-color: #f0f2f4">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
      	 <img src="./templates/sconverter1.svg" height="30" class="d-inline-block align-top" alt="">
      	Sconverter
      </a>
      <div class="ml-auto">
        <a class="btn btn-outline-light" href="./view/login/logout.php">Cambia utente</a>
        <a class="ml-2" href="https://github.com/GhislandiStefano/Sconverter" target="_blank" style="text-decoration: none;"><img src="https://konsolebox.info/images/logos/github-mark-light.svg" height="25" width="25" alt="github"></a>
        <a class="ml-2" href="https://drive.google.com/drive/folders/1U22fpwofk8ajaCQpvjTOz9iU21pEAM5x?usp=sharing" target="_blank" style="text-decoration: none;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Googledrive_logo_weiss.svg/2000px-Googledrive_logo_weiss.svg.png" height="23" width="26" alt="documentazione"></a>
      </div>
    </nav>
    <div class="container-fluid sc-div-head bg-white" style="height: 300px;">
      <div class="container-fluid sc-img-head" style="height: 250px;"></div>
      <nav class="navbar navbar-expand-lg navbar-light bg-white pl-4 ml-4 mr-4 pr-4" style="height: 50px;">
        <div style="position:relative;overflow: hidden;width:200px;height:200px; border: 4px solid white; border-radius: 5px;">
            <img src="<?php echo $_SESSION['path']; ?>" alt="profile"  style="position: relative;margin: auto;min-width:100%;height:100%;">
        </div>
        <a class="navbar-brand ml-4 text-dark" href="#"><h2><?php echo $_SESSION["utente"]; }?></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link ml-3" onclick="amici()" href="#">Amici <span id="amici" class="badge badge-dark"></span></a>
            <a class="nav-item nav-link ml-3" onclick="inviate()" href="#">Richieste Inviate <span id="inviate" class="badge badge-dark"></span></a>
            <a class="nav-item nav-link ml-3" onclick="ricevute()" href="#">Richieste Ricevute <span id="ricevute" class="badge badge-dark"></span></a>
            <a class="nav-item nav-link ml-3" onclick="converti()" href="#">Converti <span id="converti" class="badge badge-dark"></span></a>
          </div>
        </div>
      </nav>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-3 p-4" style="margin-top: 62px">
          <div class="card">
            <div class="card-header font-weight-bold">
              Cambia Password
            </div>
            <div class="card-body">
              <form action="./view/login/update-password.php" method="post" enctype="multipart/form-data">
                <input type="password" name="passwordVecchia" class="form-control mb-2" id="inputOldPassword" placeholder="Vecchia Password">
                <input type="password" name="passwordNuova" class="form-control mb-2 d-inline" id="inputNewPassword" placeholder="Nuova Password">
                <button type="submit" name="button" class="btn btn-outline-dark d-inline">Cambia</button>
              </form>
            </div>
          </div>
          <div class="card mt-4">
            <div class="card-header font-weight-bold">
              Nuova foto profilo
            </div>
            <div class="card-body">
              <form action="./view/upload/upload-images.php" method="post" enctype="multipart/form-data">
                <label class="btn btn-sm btn-outline-dark btn-file mb-0 mt-2 mr-0" id="file" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;">
                  Scegli il file<input class="btn btn-secondary text-white" name="fileToUpload" id="userfile" type="file" size="20" hidden="" onchange="NomeFile()">
                </label>
                <span id="qualeFile">
                  <a class='btn btn-dark text-white btn-sm mt-2' style='border-top-left-radius: 0px; border-bottom-left-radius: 0px;'>Vuoto</a>
                </span>
                <input class="btn btn-sm btn-primary font-weight-bold mt-2 ml-2" id="upload" type="submit" value="Carica" />


                <!--input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-secondary mt-1">
                <input type="submit" value="Carica" name="submit" class="btn btn-success mt-1"-->
              </form>
            </div>
          </div>
        </div>
        <div class="col-9 p-4" >
          <div class="card text-center" style="height: 40rem;width: 82rem">
            <div class="card-header">
              <ul id="0" class="nav nav-tabs card-header-tabs">
                <li id="1" class="nav-item">
                  <a class="nav-link active" href="#">Convert</a>
                </li>
                <li id="2" class="nav-item">
                  <a class="nav-link disabled " href="share.php">Share</a>
                </li>
                <li id="3" class="nav-item">
                  <a class="nav-link disabled" href="reconvert.php">Reconvert</a>
                </li>
              </ul>
            </div>
            <div  id="card" class="card-body">
              <h5 class="card-title">Choose the format convert your file!</h5>
              <br><br><br>
              <form id='form' action="upload.php" method="post" enctype="multipart/form-data">
                   <input id="3" type="file" name="fileToUpload" id="fileToUpload" class="btn btn-secondary mt-1">
                   <input type="submit" value="Carica" name="submit" class="btn btn-success mt-1">
                   <select id="4" name="type">
                    <option value="pdf">pdf</option>
                    <option value="jpg">jpg</option>
                    <option value="bitmap">bitmap</option>
                  </select>
                  </form>
             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
