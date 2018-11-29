<?php

$Host = "localhost";
$DBname = "testapis";
$Username = "root";
$Password = "esfera";

$connection = new mysqli($Host, $Username, $Password, $DBname);

if ($connection->connect_errno) {
    die("Connection Error");
}
