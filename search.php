<?php

session_start();

require_once("connection.php");
require_once("functions.php");

// check login true
$user_data = check_login($conn);

$outgoing_id = $_SESSION['user_id'];;
$searchTerm = pg_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} AND (user_name LIKE '{$searchTerm}')";

$output = "";

$query = pg_query($conn, $sql);

if (pg_num_rows($query) > 0) {
    include_once("data.php");
} else {
    $output = "Nehum usario encontrado";
}


echo $output;
