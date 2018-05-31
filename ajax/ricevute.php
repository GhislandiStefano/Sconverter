<?php require '../templates/header.php'; ?>
<script>

var val;

var val1;

function l(){
 
 xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                
                var data = JSON.parse(this.response);
                val = data.amici;
           
            }
        };
        xmlhttp.open("GET","../pages/parameters.php", true);
        xmlhttp.send();

 
 
}

window.setInterval(function(){
       /// call your function here
      check();
}, 1000);

function check(){



     xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                
                var data = JSON.parse(this.response);
                val1 = data.amici;
           
            }
        };
        xmlhttp.open("GET","../pages/parameters.php", true);
        xmlhttp.send();





if( val1 != val ){

   xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                
                document.getElementById("c").innerHTML = this.responseText;
                val=val1;
                
            }
        };
        xmlhttp.open("GET","/../pages/ricevute.php", true);
        xmlhttp.send();
      
      
 

}

}

function z(){
       
       
     
       
       xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                
                document.getElementById("c").innerHTML = this.responseText;
           
            }
        };
        xmlhttp.open("GET","../pages/ricevute.php", true);
        xmlhttp.send();
      
    }


</script>


  <body onload="z();l();check()" id="c">
  </body>


<?php require '../templates/footer.php'; ?>