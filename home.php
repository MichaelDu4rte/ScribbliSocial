<?php

session_start();

require_once("connection.php");
require_once("functions.php");

// check login true
$user_data = check_login($conn);

$_SESSION;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scribbli</title>

    <link rel="stylesheet" href="css/main.css" />
</head>

<body>
    <div id="preload">
        <img src="images/preload.gif" alt="" />
    </div>

    <nav>
        <div class="container">
            <h2 class="logo"><img src="images/logo.png" alt="" />Scribbli</h2>

            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="pesquisar pessoas" />
            </div>

            <div class="create">
                <label for="create-post" class="btn btn-primary">Criar</label>
                <div class="profie-picture">
                    <img src="https://as1.ftcdn.net/v2/jpg/05/16/27/58/1000_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"
                        alt="" />
                </div>
            </div>
        </div>
    </nav>

    <main class="">
        <div class="container">
            <div class="left">
                <a href="" class="profie">
                    <div class="profie-picture">
                        <img src="https://as1.ftcdn.net/v2/jpg/05/16/27/58/1000_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"
                            alt="" />
                    </div>

                    <div class="handle">
                        <h4><?= $user_data['user_name'] ?></h4>
                        <p class="text-muted">@<?= $user_data['user_name'] ?></p>
                    </div>
                </a>

                <div class="sidebar">
                    <a class="menu-item active" id="home">
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
                                    <img src="https://as1.ftcdn.net/v2/jpg/05/16/27/58/1000_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"
                                        alt="" />
                                </div>

                                <div class="notifications-body">
                                    <b>Seja bem vindo <?= $user_data['user_name'] ?></b>
                                    <small class="text-muted">Esperamos que goste da comunidade</small>
                                </div>
                            </div>


                        </div>
                    </a>

                    <a class="menu-item" id="message">
                        <span><i class="fa-solid fa-message" id=""><small
                                    class="notification-count">6</small></i></span>
                        <h3>Messages</h3>
                    </a>

                    <a class="menu-item" id="theme">
                        <span><i class="fa-solid fa-image"></i></span>
                        <h3>Tema</h3>
                    </a>
                </div>
            </div>

            <div class="center">
                <form class="create-post">
                    <div class="profie-picture">
                        <img src="https://as1.ftcdn.net/v2/jpg/05/16/27/58/1000_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"
                            alt="" />
                    </div>

                    <input type="text" placeholder="No que ta pensando?" id="create-post" />
                    <input type="submit" value="Post" class="btn btn-primary" />
                </form>

                <div class="feeds">
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profie-picture">
                                    <img src="https://as1.ftcdn.net/v2/jpg/05/16/27/58/1000_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"
                                        alt="" />
                                </div>

                                <div class="ingo">
                                    <h3>Joao</h3>
                                    <small>Dubai, 223</small>
                                </div>
                            </div>

                            <span class="id"><i class="fa-solid fa-ellipsis"></i></span>
                        </div>

                        <div class="caption">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Perferendis deleniti fuga expedita similique porro veniam
                                officiis! Voluptatum necessitatibus esse dolorum.
                            </p>
                        </div>

                        <div class="photo">
                            <img src="https://images.pexels.com/photos/3776659/pexels-photo-3776659.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="" />
                        </div>

                        <div class="action-button">
                            <div class="interaction-button">
                                <span><i class="fa-regular fa-heart"></i></span>

                                <span><i class="fa-regular fa-comment"></i></span>
                            </div>
                        </div>

                        <div class="comments text-muted">
                            ver todos os 900 comentarios
                        </div>
                    </div>

                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profie-picture">
                                    <img src="https://as1.ftcdn.net/v2/jpg/05/16/27/58/1000_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"
                                        alt="" />
                                </div>

                                <div class="ingo">
                                    <h3>Joao</h3>
                                    <small>Dubai, 223</small>
                                </div>
                            </div>

                            <span class="id"><i class="fa-solid fa-ellipsis"></i></span>
                        </div>

                        <div class="caption">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Perferendis deleniti fuga expedita similique porro veniam
                                officiis! Voluptatum necessitatibus esse dolorum.
                            </p>
                        </div>

                        <div class="photo">
                            <img src="https://images.pexels.com/photos/3776659/pexels-photo-3776659.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="" />
                        </div>

                        <div class="action-button">
                            <div class="interaction-button">
                                <span><i class="fa-regular fa-heart"></i></span>

                                <span><i class="fa-regular fa-comment"></i></span>
                            </div>
                        </div>

                        <div class="comments text-muted">
                            ver todos os 900 comentarios
                        </div>
                    </div>

                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profie-picture">
                                    <img src="https://as1.ftcdn.net/v2/jpg/05/16/27/58/1000_F_516275801_f3Fsp17x6HQK0xQgDQEELoTuERO4SsWV.jpg"
                                        alt="" />
                                </div>

                                <div class="ingo">
                                    <h3>Joao</h3>
                                    <small>Dubai, 223</small>
                                </div>
                            </div>

                            <span class="id"><i class="fa-solid fa-ellipsis"></i></span>
                        </div>

                        <div class="caption">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Perferendis deleniti fuga expedita similique porro veniam
                                officiis! Voluptatum necessitatibus esse dolorum.
                            </p>
                        </div>

                        <div class="photo">
                            <img src="https://images.pexels.com/photos/3776659/pexels-photo-3776659.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="" />
                        </div>

                        <div class="action-button">
                            <div class="interaction-button">
                                <span><i class="fa-regular fa-heart"></i></span>

                                <span><i class="fa-regular fa-comment"></i></span>
                            </div>
                        </div>

                        <div class="comments text-muted">
                            ver todos os 900 comentarios
                        </div>
                    </div>
                </div>
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

    <script src="https://kit.fontawesome.com/77ebc8126c.js" crossorigin="anonymous"></script>

    <script src="js/main.js"></script>
</body>

</html>