<?php

var_dump($_GET);
$nombre="";

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>

     <form​ ​action​=​"imprimir.php"​ ​method​=​"get"​>
       <label​ for​=​"nombre"​>​Nombre​:<?= $​nombre;  ?></label>
       <input​ type​=​"text"​ name​=​"nombre"​>
       <br>
       <label​ for​=​"email"​>​E​-​mail​:​</label>
       <input​ type​=​"text"​ name​=​"email"​>
       <br>
       <input​ ​type​=​"submit"​>
     </form>

   </body>
 </html>
