<?php

    // API 
    $timezone = $_GET['zone'];
    $url = 'http://api.timezonedb.com/v2/get-time-zone?key=PTYIG6CV3HI5&format=json&by=zone&zone='.$timezone;
    $json = file_get_contents($url);
    header('Content-type:application/json;charset=utf-8');
    echo $json;

?>