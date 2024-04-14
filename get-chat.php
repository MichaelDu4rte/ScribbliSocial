<?php

session_start();

require_once("connection.php");
require_once("functions.php");

// Verifica se o usuário está logado
$user_data = check_login($conn);

if (isset($_SESSION['user_id']) && isset($_POST['incoming_id'])) {
    // Obtém os dados do formulário
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = pg_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id WHERE
    (outgoing_msg_id = {$outgoing_id} and incoming_msg_id = {$incoming_id} OR outgoing_msg_id = {$incoming_id}
    AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

    $query = pg_query($conn, $sql);

    if (pg_num_rows($query) > 0) {
        while ($row = pg_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chatbox-message-item sent">
                    <span class="chatbox-message-item-text">
                        ' . $row['msg'] . '
                    </span>
                </div>';
            } else {
                $output .= '<div class="chatbox-message-item">
                    <span class="chatbox-message-item-text">
                        ' . $row['msg'] . '
                    </span>
                </div>';
            }
        }

        echo " " . $output . "<br>";
    } else {
        $output .= '<h4 class="chatbox-message-no-message">Você ainda não tem mensagens com essa pessoa</h4>';
    }
}
