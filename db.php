<?php

function getConnection()
{
    $database = 'cafe_database';
    $user = 'cafe123';
    $password = 'admin123';
    $host = 'db4free.net';
    
    $connect = mysqli_connect($host, $user, $password, $database);

    if (!$connect) {
        die("Could not connect to the MySQL database: " . mysqli_connect_error());
    }

    return $connect;
}

function executeQuery($connect, $query)
{
    
    $result = mysqli_query($connect, $query);

    if (!$result) {
        die("Could not execute the query: " . mysqli_error($connect));
    }

    return $result;
}

?>
