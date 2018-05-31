<?php
session_start();

$servername = "localhost";
$username = "sconverter@localhost";
$db = "my_sconverter";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit(); //termino
}

if($_POST["ricerca"]==""){
$_POST["ricerca"]= "-";
}
$_SESSION['id']=$_POST["ricerca"];
$sql="SELECT utente,path,id_utente FROM utenti WHERE utente LIKE '".$_POST["ricerca"]."%'";
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
  $i=0;
  }?>

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
<?php while($i<$f){?>
<div class="container p-2 m-3" style="box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);">
  <div class="row text-muted">
    <div class="col">
      <a target="_blank" href="../view/friends/profile.php?id=<?php echo $id["i".$i]; ?>" class="media pt-3" style="text-decoration: none;">
        <img src="../uploads/<?echo $r["p".$i];?>" alt="img" class="mr-2 rounded" style="width: 32px; height: 32px;">
        <div class="d-flex justify-content-between align-items-center w-100">
          <p>
            <small class="d-block"><?php echo $t['name'.$i];?></small>
          </p>
        </div>
      </a>

    </div>
  </div>
</div>
<?php	$i++;} ?>
</body>
</html>