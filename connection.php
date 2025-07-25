<?php

    $database= new mysqli("localhost","root","","CareTech");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>