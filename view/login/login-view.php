<?php
require '../../templates/header.php';

?>

<html>
<head>
<style>
form {
    border: 3px solid #f1f1f1;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Full-width inputs */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */


/* Add a hover effect for buttons */
button:hover {
    opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
    width: 20%;
    border-radius: 20%;
}

/* Add padding to containers */
.container {
    padding: 16px;
}

/* The "Forgot password" text */
span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
}
</style>
</head>
<div class="d-flex justify-content-center w-100 h-100">
	<div class="align-self-center jumbotron">
<form action="login-check.php" method="post" name="Login_Form">
  
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>  
  

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Log in</button>
    
    <label>
      <input type="checkbox" checked="checked"> Remember me
    </label>
  </div>
  

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
  
  
  
</form>
<form action="logon.php" method="post" name="Log_Form">
    
    
    
    <button type="submit">Sign up</button>
     
</form>
</div>
  </div>

</html>
<?php require '../../templates/footer.php'; ?>