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
<script>

function ricerca(){
       
       var r = document.getElementById("d").value;
       
       xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                
                document.getElementById("c").innerHTML = this.responseText;
               
               
           
            }
        };
        var para = "ricerca="+r;
        xmlhttp.open("POST","../pages/ricerca.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(para);
      
    }
</script>


  <body>
    <div class="p-2 jumbotron bg-white mt-4">
      <h2 class="mb-2">Ricerca Utente</h2>
      <input id="d" onkeyup="ricerca()" name="s" class="form-control mb-0" style="border-bottom-right-radius: 0; border-bottom-left-radius: 0; " placeholder="Cerca utente">
       <div id="c">
       </div>
    </div>
  </body>