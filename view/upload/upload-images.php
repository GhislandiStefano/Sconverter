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
session_start();
$target_dir= "../../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo $target_file;

?>

<?php
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('Impossibile caricare il file selezionato'); window.location = 'index0.php';</script>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
    } else {
        
        echo "<script>alert('Impossibile caricare il file selezionato'); window.location = '../../index.php';</script>";
    }
}


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
$sql = "UPDATE utenti SET path='".basename( $_FILES["fileToUpload"]["name"])."' WHERE utente='".$_SESSION["utente"]."'";

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

?>



