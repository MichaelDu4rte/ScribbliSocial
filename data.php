<?php

require_once("search.php");

while ($row = pg_fetch_assoc($query)) {

    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['user_id']} 
        OR outgoing_msg_id = {$row['user_id']}) AND (outgoing_msg_id = {$outgoing_id} 
        OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

    $query2 = pg_query($conn, $sql2);
    $row2 = pg_fetch_assoc($query2);

    $result = (pg_num_rows($query2) > 0) ? $row2['msg'] : "Sem mensagens";
    $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

    if (isset($row2['outgoing_msg_id'])) {
        $you = ($outgoing_id == $row2['outgoing_msg_id']) ? "Você" : "";
    } else {
        $you = "";
    }

    $hid_me = ($outgoing_id == $row['user_id']) ? "hide" : "";

    $output .= '<a href="home.php?user_id=' . $row['user_id'] . '">
        <div class="content">
            <img  src="' . $row['user_image'] . '">
            <div class="details">
                <span>' . $row['user_name'] . '</span>
                <p>' . $you . $msg . '</p>
            </div>
        </div>
    </a>';
}
