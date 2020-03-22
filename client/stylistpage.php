<?php

include_once 'class/client.class.php';
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet"href="css/style2.css">
    </head>
    <body>
        <div class="main-container">   
        <?php
    echo $_SESSION['stylistid'];
        ?> 
  
<div>
             
       <div id="recommendations">
       	<?php
       $get = new client();
       $result = $get->getImage();
       foreach($result as $row)
       {
       echo '<img src="data:image/jpg;base64,'.base64_encode($row['image']).'"width="250px" height="250px"/>'; ?> 

        <a href="#">Visit this stylist <?php echo $row['stylistid']; ?></a>
       <?php
     }
       ?>

       </div>
     
    
    </body>

</html>