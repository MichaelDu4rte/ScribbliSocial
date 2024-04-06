<?php


$dbhost = "localhost";
$dbuser = "postgres";
$dbpassword = "admin";
$dbname = "ScribbliDB";


$conn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpassword");
