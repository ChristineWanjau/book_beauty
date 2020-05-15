<?php
$n = 9;
$ar  = array(10,20,10,20,10,30,40,10,20);
    $count = 0;
     for($i=0;$i<$n;$i++){
         for($j=0;$j<$n;$j++){
             if($ar[$i] == $ar[$j]){
                 echo $ar[$i];
                 $count++;
             }
         }
     }
     echo $count;


?>