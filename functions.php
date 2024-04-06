<?php


function check_login($conn)
{
    if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = $id LIMIT 1";

        $result = pg_query($conn, $query);

        if ($result && pg_num_rows($result) > 0) {

            $user_data = pg_fetch_assoc($result);

            return $user_data;
        }
    }
    header("Location: index.php");
    die;
}


function random_num($length)
{

    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {

        $text .= rand(0, 9);
    }

    return $text;
}

function checkEmailCreate($conn, $user_email)
{
}



function userLoginOrRegister($conn)
{
    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['register'])) {

        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if (!empty($user_email) && !empty($password) && !empty($user_name)) {

            // Verificar se o email já existe
            $check_query = "SELECT COUNT(*) FROM users WHERE user_email = '$user_email'";
            $check_result = pg_query($conn, $check_query);
            $row = pg_fetch_row($check_result);
            $email_count = $row[0];

            // Se o email já existir, exibir uma mensagem
            if ($email_count > 0) {
                echo "O email já está em uso. Por favor, escolha outro email.";
                die;

                // caso nao exista, posso prosseguir
            } else {

                // gerando o user_id
                $user_id = rand(4, 10000000000);

                // Hash da senha
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Inserir dados no banco de dados
                $query = "INSERT INTO users (user_id, user_name, user_email, password) VALUES ('$user_id', '$user_name', '$user_email', '$hashed_password')";
                pg_query($conn, $query);

                header("Location: index.php");
                die;
            }
        }

        // form login 
    } else if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login'])) {

        $user_email = $_POST['user_email'];
        $password = $_POST['password'];

        if (!empty($user_email) && !empty($password)) {

            // Consultar o banco de dados para obter o hash da senha associada ao e-mail
            $query = "SELECT user_id, password FROM users WHERE user_email = '$user_email' LIMIT 1";
            $result = pg_query($conn, $query);

            if ($result && pg_num_rows($result) > 0) {

                $user_data = pg_fetch_assoc($result);

                // Verificar se a senha fornecida corresponde ao hash armazenado no banco de dados
                if (password_verify($password, $user_data['password'])) {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: home.php");
                    die;
                }
            }
        }
    }
}
