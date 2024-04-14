<?php

session_start();

require_once("connection.php");
require_once("functions.php");

session_unset();

userLoginOrRegister($conn);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scribbli | Login</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form autocomplete="off" class="sign-in-form" method="POST">
                        <div class="logo">
                            <img src="images/logo.png" alt="easyclass" />
                            <h4>Scribbli</h4>
                        </div>

                        <div class="heading">
                            <h2>Bem vindo</h2>
                            <h6>Nao tem conta?</h6>
                            <a href="#" class="toggle">Criar</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="email" name="user_email" class="input-field" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" class="input-field" autocomplete="off" required />
                                <label>Senha</label>
                            </div>

                            <input type="submit" value="Entrar" class="sign-btn" name="login" />
                        </div>
                    </form>

                    <form autocomplete="off" class="sign-up-form" method="POST">
                        <div class="logo">
                            <img src="images/logo.png" alt="easyclass" />
                            <h4>MDSOCIAL</h4>
                        </div>

                        <div class="heading">
                            <h2>Registrar</h2>
                            <h6>Ja tem conta?</h6>
                            <a href="#" class="toggle">Entrar</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="user_name" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Nome</label>
                            </div>

                            <div class="input-wrap">
                                <input type="email" name="user_email" class="input-field" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" minlength="5" class="input-field" autocomplete="off" required />
                                <label>Senha</label>
                            </div>

                            <input type="submit" value="Criar" class="sign-btn" name="register" />

                            <p class="text">
                                Ao criar sua conta, você aceita os
                                <a href="#">Termos de Serviços</a> e
                                <a href="#">Politicas de Privacidade</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="./img/image1.png" class="image img-1 show" alt="" />
                        <img src="./img/image2.png" class="image img-2" alt="" />
                        <img src="./img/image3.png" class="image img-3" alt="" />
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Compartilhe suas ideias</h2>
                                <h2>Conheça novas pessoas</h2>
                                <h2>Construa conexões autênticas</h2>
                                <h2>Faça parte de uma comunidade</h2>
                            </div>
                        </div>

                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                            <span data-value="4"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/login.js"></script>
    <script src="js/main.js"></script>


</body>

</html>