<?php

session_start();

require_once("connection.php");
require_once("functions.php");

// check login true
$user_data = check_login($conn);

$_SESSION;


// Verifica se o ID do post foi enviado via POST


// Verifica se o usuário já curtiu este post nesta sessão
if (isset($_SESSION['liked_posts']) && in_array($_POST['post_id'], $_SESSION['liked_posts'])) {

    exit(); // Encerra o script para evitar execução adicional
}


if (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    $userId = $user_data['user_id'];

    // Verifica se o usuário já reagiu ao post com base na tabela reactions
    $query = "SELECT COUNT(*) AS count FROM reactions WHERE user_id = $userId AND post_id = $postId";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);
    $reactionCount = $row['count'];

    // Verifica se o post já foi curtido na sessão atual
    $likedPosts = isset($_SESSION['liked_posts']) ? $_SESSION['liked_posts'] : array();
    $likedInSession = in_array($postId, $likedPosts);

    if ($reactionCount == 0 && !$likedInSession) {
        // Se o usuário ainda não reagiu ao post, atualiza o contador de likes no banco de dados
        $query = "UPDATE posts SET post_like = post_like + 1 WHERE post_id = $postId";
        pg_query($conn, $query);

        // Registra a reação do usuário na tabela de reações
        $query = "INSERT INTO reactions (user_id, post_id, reaction_type, created_at) VALUES ($userId, $postId, 'like', NOW())";
        pg_query($conn, $query);

        // Retorna o novo número de likes do post
        $query = "SELECT post_like FROM posts WHERE post_id = $postId";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);
        echo $row['post_like'];

        // Adiciona o post à lista de posts curtidos nesta sessão
        $_SESSION['liked_posts'][] = $postId;
    } else {
        // Se o usuário já reagiu ao post ou já curtiu na sessão, retorna o número atual de likes
        $query = "SELECT post_like FROM posts WHERE post_id = $postId";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);
        echo $row['post_like'];
    }
}