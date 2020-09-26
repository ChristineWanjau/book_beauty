<?php

include_once 'class/client.class.php';
include_once 'class/service.class.php';
include_once 'class/review.class.php';
include_once 'class/notifications.class.php';
include_once 'class/stylist.class.php';

session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet"href="css/style2.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="main-container">
            <div class="topnav" id="myTopnav">
              <div class="nav-logo">
                <p>Book Beauty</p>
              </div>
                  <div class="search-container">
      <form action="index.php" method="get">
    <input type="text" class="search" required=""placeholder="Where are you looking for?" name ="location">
    <button type="submit"name="search"><i class="fa fa-search"></i></button>
    </form>
    </div>
              <a href="stylistlogin.php">Sign up for businesses</a>
              <a href="clientlogin.php">Log in</a>
               <div class="dropdown">
               <button class="dropbtn"><?php if(isset($_SESSION['clientemail'])){
                echo $_SESSION['clientemail'];
                ?>
                <sup class="sms" style="background-color:green;">
                  <?php
                  $noti = new notifications();
                  $sms = $noti->getNumberOfsms($_SESSION['clientemail']);
                  echo $sms;               
                  ?>
                </sup>
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
               <a href="clientappointments.php">Your appointments</a>
               <a href="message.php">Your messages</a>
              <a href="clientlogout.php">Logout</a>
        </div>
        <?php 
               };?>
  </div>

</div>
  <div class="banner-title">
        <p><b></b></p>

</div>
<br>
</div>
<div class="topic">
<h1>- Some of the services you can find -</h1>
</div>
<div class="services">
  <ul>
    <?php
     $gett= new service();
     $offers = $gett->getServicesOffered();
     foreach($offers as $row){
      ?>
    <li><b><a href="?getSpecific=<?php echo $row['service'];?>"><?php echo $row['service'];?></a></b></li>
    <?php
  }
  ?>
  </ul>
  </div>
      <div class="topic">
        <h1>- Recommendations -</h1>
      </div>
       <div id="recommendations">
       	<?php

        if(isset($_GET['search'])){
          ?>
          <div id="searched">
          <?php
           echo "<script>
           window.location.href='#searched';
           </script>";
           $location = $_GET['location'];
           $get = new stylist();
           $style = $get->getSalonistByLocation($location);
           foreach($style as $stylist){
            $gotten = $get->getImageForStylist($stylist['stylistid']);
            foreach($gotten as $got){
               $imagename = "upload/".$got['name'];
            
            ?>
            <div class="image">
              <a href="?stylist=<?php echo $stylist['stylistid'];?>" type="button"><img src ="<?php echo $imagename;?>" width='200px' height='200px'></a>
                <div class="textbox">
                  <p><?php
                 $style = new stylist();
                 $salon = $style->getEmail($stylist['stylistid']);
                 foreach ($salon as $row) {
                 echo $row['businessname'];
              }

          ?>
          <p>Located at:<?php echo $stylist['city'];
              echo $stylist['street']; ?></p>

         </p>
       </div>
     </div>
       <?php
     }
     }
     ?>
     </div>
     <?php
        }
     elseif(isset($_GET['getSpecific'])){
      ?>
         <div id="specified">
          <?php
          echo "<script>
           window.location.href='#specified';
           </script>";
           $specific_service = $_GET['getSpecific'];
           $specificstylist = $gett->getSalonistByService($specific_service);
           foreach($specificstylist as $stylist){
               $image = $stylist['image_name']; 
            ?>
            <div class="image">
              <a href="?stylist=<?php echo $stylist['stylistid'];?>" type="button"><img src ="<?php echo $image;?>" width='200px' height='200px'></a>
                <div class="textbox">
                  <p><?php 
                 $style = new stylist();
                 $salon = $style->getEmail($stylist['stylistid']);
                 foreach ($salon as $row) {
                 echo $row['businessname'];
              }

           ?>
         </p>
       </div>
     </div>
     <?php
      }
     ?>
     </div>
     <?php
        }else{
        $cust = new client();
       $result = $cust->getImage();
       foreach ($result as $images) {
          $imagesrc ="upload/".$images['name']; 
        ?> 
        <div class="image">      
        <a href="?stylist=<?php echo $images['stylistid'];?>" type="button"><img src ="<?php echo $imagesrc;?>" width='200px' height='200px'></a>
        <div class="textbox">
          <p>Name:<?php 
          $style = new stylist();
          $salon = $style->getEmail($images['stylistid']);
          foreach ($salon as $row) {
            echo $row['businessname'];
        }?>
        Location:<?php
        $location = $style->getLocation($images['stylistid']);
        foreach ($location as $place) {
        
          echo $place['city'];
          echo $place['street'];
        }
        ?>
          
          </p>
        </div>
      </div>
       <?php
     }
     }

    ?>
  </div>
<div class="topic"> 
<h1>- Why Book Beauty? -</h1>
</div>
<div class="advertise">
   <img src="images/photo2.jpg.jpg" alt="Notebook">
  <div class="content">
    <h1>For Businesses</h1>
    <p>Advertise your business now<br>Enable your customers to book with you anytime and any day</p>
    <button class="btn"><a href="stylistlogin.php">Join Now</a></button>
  </div>
  </div>
  <div class="topic">
    <h1>- Join our happy customers -</h1>
  </div>
  <!-- <div class="reviews">
   <?php 
   $now = new review();
   $reviews = $now->getAllReviews();
   foreach ($reviews as $text) {
    ?>
  <div class="client">
    <img src="images/salon.jpg"  style="width:200px; height: 200px">
    <div class="content"><?php echo $text['review'];?></div>
    </div>
    <?php
  }?>
</div> -->

<div class="footer">
  <p>Contact us</p>
  <p>bookbeauty@gmail.com<p>
  <p>Twitter:  @bookbeauty</p>
  <p>Located at: Muindi Mbingu Street,Nairobi Kenya</p>
</div>
    </body>
    <?php
     if(isset($_GET['stylist'])){
        $stylist = $_GET['stylist'];
        $_SESSION['stylistid'] = $stylist;
        echo "<script>
        window.location.href='stylistpage.php';
        </script>";
      }

    ?>
</html>