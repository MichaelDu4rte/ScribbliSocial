<div class="customize-theme" id="customize-theme">
    <div class=" card">
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
                <label for="">Bio:</label>
                <input type="text" value="<?= $user_data['description'] ?>" name="description" required>

                <label for="file-upload" class="custom-file-upload" value="<?= $user_data['user_image'] ?>">Mudar foto
                    de perfil</label>
                <input id="file-upload" value="<?= $user_data['user_image'] ?>" type="file" accept=".jpg, .jpeg, .png"
                    name="image" />

                <input type="submit" class="button" value="Salvar" name="btn-salve">
            </form>

        </div>

    </div>
</section>



<section class="wrapper2">
    <section class="users">
        <div class="header">
            <div class="content">
                <img src="<?= $user_data['user_image'] ?>" alt="">

                <div class="details">
                    <span><?= $user_data['user_name'] ?></span>
                    <a><i class="fa-solid fa-x"></i></a>
                </div>
            </div>
        </div>

        <div class="search">
            <span class="text" style="margin-bottom: 0.6rem;">Pesquise alguem para conversar</span>
            <input type="text" placeholder="Pesquisar...">

        </div>

        <div class="users-list">

        </div>

    </section>

</section>


<div class="chatbox-wrapper">
    <div class="chatbox-toggle">
        <i class="fa-solid fa-message"></i>
    </div>

    <div class="chatbox-message-wrapper">
        <div class="chatbox-message-header">
            <div class="chatbox-message-profile">
                <img src="<?= $row['user_image'] ?>" alt="">

                <div>
                    <h4 class="chatbox-message-name"><?= $row['user_name'] ?></h4>

                </div>
            </div>


        </div>

        <div class="chatbox-message-content">



        </div>


        <div class="chatbox-message-bottom">
            <form class="typing-area chatbox-message-form" method="POST">
                <input type="text" class="incoming_id" name="incoming_id" value="<?= $user_data['user_id'] ?>" hidden>
                <input type="text" class="input-fild chatbox-message-input" name="message" placeholder="digite ai"
                    autocomplete="off">
                <button type="submit" class="chatbox-message-submit " id="sendBtn" name="submit"><i
                        class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>

<script src="js/main.js"></script>
<script src="js/chat.js"></script>
<script src="js/like.js"></script>
<script src="js/userChat.js"></script>

<script src="https://kit.fontawesome.com/77ebc8126c.js" crossorigin="anonymous"></script>




<script>

</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    setInterval(() => {
        let xrm = new XMLHttpRequest();

        xrm.open("POST", "get-chat.php", true);
        xrm.onload = () => {
            if (xrm.readyState === XMLHttpRequest.DONE) {
                if (xrm.status === 200) {
                    let data = xrm.response;
                    let chatBox = document.querySelector(
                        '.chatbox-message-content'); // Selecionar o elemento chat-box
                    if (chatBox) { // Verificar se o elemento existe antes de acessá-lo
                        chatBox.innerHTML = data;
                    } else {
                        console.error(
                            "Elemento .chatbox-message-content não encontrado na página.");
                    }
                } else {
                    console.error("Erro ao receber a resposta da requisição: " + xrm
                        .statusText);
                }
            }
        };

        xrm.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xrm.send("incoming_id=<?= $user_data['user_id'] ?>");
    }, 500);
});
</script>

<script>
var chatModal = document.querySelector(".wrapper2");
var chatLink = document.getElementById("message");
var closeButton = document.querySelector(".wrapper2 .fa-x");

const chatboxWrapper = document.querySelector('.chatbox-wrapper .chatbox-message-wrapper');
const chatboxToggle = document.querySelector('.chatbox-wrapper .chatbox-toggle');

// Exibir o modal quando o link for clicado
chatLink.addEventListener("click", function(event) {
    chatModal.style.display = "flex";
    chatboxWrapper.classList.remove('show');

});

// Fechar o modal quando o usuário clicar no ícone de fechar
closeButton.addEventListener("click", function(event) {
    chatModal.style.display = "none";
});


// Verifica se a URL contém "user_id" e "home.php"
if (window.location.href.includes("user_id") && window.location.href.includes("home.php")) {


    if (chatboxWrapper) {
        // Adiciona a classe "show" se a verificação for bem-sucedida
        chatboxWrapper.classList.add('show');
    }


    if (chatboxToggle) {
        chatboxToggle.style.display = "flex";

        // Adiciona o ouvinte de evento para o chatboxToggle
        chatboxToggle.addEventListener('click', function() {
            chatboxWrapper.classList.toggle('show');
            console.log('chatbox');
        });
    }

    // dropdown
    const dropdownToggle = document.querySelector('.chatbox-message-dropdown-toggle');
    const dropdownMenu = document.querySelector('.chatbox-message-dropdown-menu');

    dropdownToggle.addEventListener('click', function() {
        dropdownMenu.classList.toggle('show');
        console.log('chatbox');
    });
}
</script>

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