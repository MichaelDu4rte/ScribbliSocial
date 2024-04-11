<?php

session_start();

require_once("connection.php");
require_once("functions.php");

// check login true
$user_data = check_login($conn);

$_SESSION;

// get input post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send-post']) && !empty($_POST['create-post'])) {

    // post infos
    $post_text = $_POST['create-post'];

    // id user login
    $user_id = $user_data['id'];

    // send db
    pg_query($conn, "INSERT INTO posts (user_id, post_text) VALUES ('$user_id', '$post_text')");

    // reload for home
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}



// get all posts
$result = pg_query($conn, "SELECT users.user_name, users.user_image, posts.post_date, posts.post_text, posts.post_id, posts.post_like
                           FROM posts 
                           INNER JOIN users ON posts.user_id = users.id
                           ORDER BY posts.post_id DESC");

$posts = pg_fetch_all($result) ?: [];


if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    // Obtém o ID do usuário da URL
    $user_id = $_GET['user_id'];

    // Executa a consulta SQL usando o ID do usuário
    $result = pg_query($conn, "SELECT users.user_name, users.user_image, posts.post_date, posts.post_text, posts.post_id, posts.post_like
                               FROM posts 
                               INNER JOIN users ON posts.user_id = users.id
                               WHERE users.id = $user_id
                               ORDER BY posts.post_id DESC");

    $profie = pg_fetch_all($result) ?: [];
}

updateProfie($conn);

// end db
pg_close($conn);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scribbli</title>

    <link rel="stylesheet" href="css/main.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div id="preload">
        <img src="images/preload.gif" alt="" />
    </div>

    <nav>
        <div class="container">
            <a href="home.php">
                <h2 class="logo"><img src="images/logo.png" alt="" />Scribbli</h2>
            </a>

            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="pesquisar pessoas" />
            </div>

            <div class="create">
                <label for="create-post" class="btn btn-primary">Criar</label>
                <div class="profie-picture">
                    <img src="<?= $user_data['user_image'] ?>" alt="" />
                </div>
            </div>
        </div>
    </nav>

    <main class="">
        <div class="container">
            <div class="left">
                <a href="profie.php?user_id=<?= $user_data['id'] ?>" class="profie">
                    <div class="profie-picture">
                        <img src="<?= $user_data['user_image'] ?>" alt="" />
                    </div>
                    <div class="handle">
                        <h4><?= $user_data['user_name'] ?></h4>
                        <p class="text-muted">@<?= $user_data['user_name'] ?></p>
                    </div>
                </a>

                <div class="sidebar">
                    <a class="menu-item active" id="home" href="home.php">
                        <span><i class="fa-solid fa-house"></i></span>
                        <h3>Home</h3>
                    </a>

                    <a class="menu-item" id="profie">
                        <span><i class="fa-solid fa-user"></i></span>
                        <h3>Perfil</h3>
                    </a>

                    <a class="menu-item" id="notification">
                        <span><i class="fa-solid fa-bell"><small class="notification-count">2</small></i></span>
                        <h3>Notificações</h3>

                        <div class="notifications-popup">
                            <div>
                                <div class="profie-picture">
                                    <img src="<?= $user_data['user_image'] ?>" alt="" />
                                </div>

                                <div class="notifications-body">
                                    <b>Seja bem vindo <?= $user_data['user_name'] ?></b>
                                    <small class="text-muted">Esperamos que goste da comunidade</small>
                                </div>
                            </div>


                        </div>
                    </a>

                    <a class="menu-item" id="message">
                        <span><i class="fa-solid fa-message" id=""><small class="notification-count">6</small></i></span>
                        <h3>Messages</h3>
                    </a>

                    <a class="menu-item" id="theme">
                        <span><i class="fa-solid fa-image"></i></span>
                        <h3>Tema</h3>
                    </a>

                    <a class="menu-item" id="logout" href="index.php">
                        <span><i class="fa-solid fa-right-from-bracket" style=" transform: scaleX(-1);" id="logout"></i></span>
                        <h3>Sair</h3>
                    </a>
                </div>
            </div>

            <div class="center">
                <div class="profie-container">

                    <div class="profie-banner">
                        <img class="cover-img" src="https://as1.ftcdn.net/v2/jpg/04/10/34/54/1000_F_410345403_tV5hpFLJ7VCSgsAYJRC74tG4DA9LTXyC.jpg" alt="">

                    </div>

                    <?php if (!empty($profie)) : ?>
                        <div class="profie-details">
                            <?php $profie_user = $profie[0]; // Apenas um dos usuários é suficiente para exibir os detalhes do perfil 
                            ?>
                            <div class="profie-details-left">
                                <div class="profie-details-row">
                                    <img src="<?= $profie_user['user_image']; ?>" alt="" class="profie-details-image">
                                    <div>
                                        <h3><?= $profie_user['user_name']; ?></h3>

                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum, a.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="profie-deitals-right">
                                <button type="button"><i class="fa-solid fa-message"></i>Message</button>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>



                <div class="feeds">

                    <?php foreach ($profie as $profie_user) : ?>
                        <div class="feed">

                            <div class="head">
                                <div class="user">
                                    <div class="profie-picture">
                                        <img src="<?= $profie_user['user_image']; ?>" alt="" />
                                    </div>

                                    <div class="ingo">
                                        <h3><?= $profie_user['user_name'] ?></h3>
                                        <small><?= $profie_user['post_date'] ?></small>
                                    </div>
                                </div>

                                <span class="id"><i class="fa-solid fa-ellipsis"></i></span>
                            </div>

                            <div class="caption">
                                <p><?= $profie_user['post_text']; ?>
                                </p>
                            </div>

                            <div class="action-button" style="margin-top: 0.6rem;">
                                <div class="interaction-button">

                                    <!-- Adicione um atributo de data com o ID do post -->
                                    <button class="like-button" id="btn-post" data-post-id="<?= $profie_user['post_id']; ?>">
                                        <span id="post-like"><i style="margin-right: 0.4rem;" class="fa-regular fa-heart"></i><?= $profie_user['post_like']; ?></span></button>
                                </div>

                            </div>


                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="left">

                </div>
            </div>
    </main>

    <div class="customize-theme">
        <div class="card">
            <h2>Configurar Layout</h2>

            <div class="background">
                <h4>Background</h4>

                <div class="choose-bg">
                    <div class="bg-1 active">
                        <span class=""></span>
                        <h5 for="bg-1">Light</h5>
                    </div>

                    <div class="bg-2">
                        <span class=""></span>
                        <h5 for="bg-2">Dim</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="user-info" class="modal-user">
        <div class="container">

            <div class="user-config form">
                <h1>Alterar dados</h1>

                <form action="#" method="POST" name="user-info-form" enctype="multipart/form-data">
                    <label for="Nome">Nome:</label>
                    <input type="text" value="<?= $user_data['user_name'] ?>" name="name" required>
                    <label for="">Email:</label>
                    <input type="email" value="<?= $user_data['user_email'] ?>" name="email" required>

                    <label for="file-upload" class="custom-file-upload">Mudar foto de perfil</label>
                    <input id="file-upload" type="file" accept=".jpg, .jpeg, .png" name="image" />

                    <input type="submit" class="button" value="Salvar" name="btn-salve">
                </form>

            </div>

        </div>
    </section>



    <script src="https://kit.fontawesome.com/77ebc8126c.js" crossorigin="anonymous"></script>

    <script src="js/main.js"></script>


    <script>
        $(document).ready(function() {


            // Adiciona um evento de clique ao botão de like
            $(".like-button").click(function() {



                // Obtém o ID do post do atributo de data
                var postId = $(this).data("post-id");
                console.log("Post ID:",
                    postId); // Verifique se o ID do post está sendo capturado corretamente
                // Envia uma requisição AJAX para o servidor
                $.ajax({
                    url: "update_like.php", // Arquivo PHP para processar a requisição
                    type: "POST",
                    data: {
                        post_id: postId
                    }, // Dados enviados para o servidor
                    success: function(response) {
                        console.log("Response:",
                            response); // Verifique se o servidor está respondendo corretamente

                        location.reload();



                    },
                    error: function(xhr, status, error) {
                        console.error("Error:",
                            error); // Verifique se há erros na requisição AJAX
                    }
                });
            });
        });
    </script>
</body>

</html>