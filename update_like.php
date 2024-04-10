<?php

session_start();

require_once("connection.php");
require_once("functions.php");

// check login true
$user_data = check_login($conn);

$_SESSION;


// Verifica se o ID do post foi enviado via POST
if (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];

    // Verifica se o usuário já reagiu ao post (você precisa implementar essa verificação)
    // Por exemplo, você pode verificar se já existe uma entrada na tabela de reações com o ID do usuário e do post

    // Se o usuário ainda não reagiu ao post, atualiza o contador de likes no banco de dados
    // Suponha que a tabela POSTS tenha um campo post_like que armazena o número de likes
    $query = "UPDATE posts SET post_like = post_like + 1 WHERE post_id = $postId";
    pg_query($conn, $query);

    // Retorna o novo número de likes do post
    $query = "SELECT post_like FROM posts WHERE post_id = $postId";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);
    echo $row['post_like'];
} else {
    // Se o ID do post não foi enviado, retorna um erro
    echo "Erro: ID do post não foi enviado";
}
