<?php
session_start();

require_once("connection.php");
require_once("functions.php");

// Verifica se o usuário está logado
$user_data = check_login($conn);

if (isset($_SESSION['user_id'])) {


    // Obtém os dados do formulário
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = pg_escape_string($conn, $_POST['incoming_id']);

    $message = pg_escape_string($conn, $_POST['message']);

    // Verifica se a mensagem não está vazia e executa a inserção no banco de dados
    if (!empty($message)) {
        $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES
            ({$incoming_id}, {$outgoing_id}, '{$message}')";

        $result = pg_query($conn, $sql);
    } else {
        echo "A mensagem está vazia.";
    }
} else {
    header("Location: index.php");
}
