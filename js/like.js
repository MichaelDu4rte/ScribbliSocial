// Seleciona todos os botões de curtir
var likeButtons = document.querySelectorAll('.like-button');

// Percorre cada botão de curtir
likeButtons.forEach(function(button) {
    // Obtém o ID do post associado ao botão
    var postId = button.getAttribute('data-post-id');
    var userId = button.getAttribute('data-user-id'); // Obtém o ID do usuário associado ao botão

    // Verifica se o botão já foi curtido anteriormente pelo usuário atual
    var isLiked = localStorage.getItem('isLiked_' + userId + '_' + postId) === 'true';

    // Atualiza a classe do botão com base no estado armazenado
    if (isLiked) {
        button.classList.add('active');
    }

    // Adiciona um event listener para o clique no botão
    button.addEventListener('click', function() {
        // Verifica se o botão já possui a classe .active
        var isActive = button.classList.contains('active');

        // Alterna o estado do botão
        if (!isActive) {
            button.classList.add('active');
            // Armazena o estado do like do usuário atual
            localStorage.setItem('isLiked_' + userId + '_' + postId, 'true');
        }
    });
});
