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
        <div class="navbar">
            <div class="nav-logo">
			<p>Book Beauty</p>
			</div>
		
			<input type="text" class="search" placeholder="What are you looking for?">
			<input type="text" class="search" placeholder="Where are you?">
            <div class="nav-links">
			<ul>
				<li><a href="stylists/stylistlogin.php">SIGN FOR BUSINESES</a></li>
				<li><a href="register.html">SIGN IN</a></li>
			</ul>
			
			</div>
           </div>
		   <div class="banner-title">
				<p> Look Good <br><span>Feel Good</span> in your own skin</p>
				<button class="btn"><a href="#recommendations">EXPLORE</a></button>
			</div>
		   <div class="vertical-bar">
		   <div class="search-icon"></div>
		   <div class="social-icon"></div>
		   
		   </div>
  
</div>
             
       <div id="recommendations">
       	<?php
       $get = new client();
       $result = $get->getImage();
       foreach($result as $row)
       {
       echo '<img src="data:image/jpg;base64,'.base64_encode($row['image']).'"width="250px" height="250px"/>'; ?> 
           
        <a href="?stylist=<?php echo $row['stylistid'];?>" type="button">Visit this stylist <?php echo $row['stylistid']; ?></a>
       <?php
     }
       ?>
       </div>
       <?php

      if(isset($_GET['stylist'])){
        $stylist = $_GET['stylist'];
        $_SESSION['stylistid'] = $stylist;
        echo "<script>
        window.location.href='stylistpage.php';
        </script>";
      }
     
    ?>
    </body>

</html>