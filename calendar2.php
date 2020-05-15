<?php

session_start();
include_once 'class/stylist.class.php';
include_once 'load.php';
if(isset($_SESSION['stylistid'])){

?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link rel="stylesheet"href="css/home.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="css/calendar.css" rel="stylesheet">
    <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='fullcalendar/packages/interaction/main.css' rel='stylesheet' />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


    <script src='fullcalendar/packages/core/main.js'></script>
    <script src='fullcalendar/packages/daygrid/main.js'></script>
    <script src='fullcalendar/packages/timegrid/main.js'></script>
    <script src='fullcalendar/interaction/main.js'></script>

    <script>

      document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
    selectable: true,
    editable:true,
     header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    navLinks: true,
    weekNumbers: true,
    nowIndicator: true,
    businessHours: true,
     editable: true,
      events: [
      <?php
      for($i=0;$i<2;$i++){
        ?>
    { 
      
      title: '<?php echo $data[$i][1]?>',
      start: '<?php echo $data[$i][2]?>',
      end:'<?php echo $data[$i][3] ?>',
    },
  <?php 
}
?>
],

  });

  calendar.render();
});

    </script>


  </head>
  <body>
    <input type="checkbox"id="check">
  <label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-times" id="cancel"></i>
  </label>
  <div class="sidebar">
    <header>Stylist</header>
    <ul>
      <li><a href="stylisthome.php"><i class="fas fa-qrcode"></i>My Profile</a><li>
      <li class="active"><a href="service.php"><i class="fas fa-link"></i>Services</a><li>
      <li><a href="calendar2.php"><i class="far fa-calendar"></i>Calendar</a><li>
      <li><a href="stylistappointments.php"><i class="fas fa-stream"></i>Appointments</a><li>
        <li><a href="#"><i class="fas fa-calendar-week"></i>Reviews</a><li>
        <li><a href="#"><i class="fas fa-question-circle"></i>About</a><li>
        <li><a href="#"><i class="fas fa-sliders-h"></i>Contact</a><li>
    </ul>
  </div>
  <section>
    <div class="logo">
      <h1>Your Calendar</h1>
    </div>
    <hr>

    <div id='calendar'></div>

  </body>
</html>
<?php

}
else{

  echo "
  <script>
  alert('login first');
  window.location.href='stylistlogin.php';
  </script>";
  
}