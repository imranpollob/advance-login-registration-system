<?php

$con = mysqli_connect("localhost","root","","login_db");




function escape($string){
    global $con;
    return mysqli_real_escape_string($con, $string);
}

function query($query){
    global $con;
    return mysqli_query($con, $query);
}

function confirm($result){
    global $con;
    if (!$result){
        die("Query Failed" . mysqli_error($con));
    }
}

function fetch_array($result){

    return mysqli_fetch_array($result);
}

function row_count($result){
    return mysqli_num_rows($result);
}
?>

