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

function userLoginOrRegister($conn)
{
    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['register'])) {

        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $user_image = 'images/profiePlaceholder.jpg';

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
                $query = "INSERT INTO users (user_id, user_name, user_email, password, user_image) VALUES ('$user_id', '$user_name', '$user_email', '$hashed_password', '$user_image')";
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


function updateProfie($conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btn-salve"])) {


        // Obtém os valores do formulário
        $user_name = $_POST["name"];
        $user_email = $_POST["email"];
        $user_description = $_POST["description"];
        $user_data = check_login($conn);

        // Pasta onde as imagens serão armazenadas
        $target_dir = "images/";

        // Nome da imagem
        $image = basename($_FILES["image"]["name"]);

        $image_extension = pathinfo($image, PATHINFO_EXTENSION);

        // image name
        $custom_image_name = $user_name . "_" . $user_data['id'] . "." . $image_extension;

        // Caminho completo para a imagem
        $target_file = $target_dir . $custom_image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Prepara a instrução SQL para atualizar os dados do usuário
            $sql = "UPDATE users SET user_name='$user_name', user_email='$user_email', user_image='$target_file', description='$user_description' WHERE id = {$user_data['id']}";

            // Executa a instrução SQL
            $result = pg_query($conn, $sql);

            header("Location: home.php");
        } else {
            header("Location: home.php");
        }
    }
}
