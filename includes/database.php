<?php

 $db = mysqli_connect('localhost','root', '1376', 'citas');

 if(!$db){
    echo "Hubo un error";
    exit;
 }