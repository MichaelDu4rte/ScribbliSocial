
const form = document.querySelector('.typing-area'),
incoming_id = form.querySelector('.incoming_id').value,
inputField = form.querySelector('.input-fild'),
sendBtn = form.querySelector('#sendBtn'),
chatBox = form.querySelector('.chat-box')




form.onsubmit = (e) => {
    e.preventDefault()
}

inputField.focus();

sendBtn.onclick = () => {
    let xrm = new XMLHttpRequest();

    console.log("cliquei");

    xrm.open("POST", "insert-chat.php", true);

    xrm.onload = () => {
        console.log("Recebido resposta da requisição"); // Verificar se o evento onload está sendo acionado
        if (xrm.readyState === XMLHttpRequest.DONE) {
            if (xrm.status === 200) {
                inputField.value = ""; // Limpa o campo de entrada se a requisição for bem-sucedida
            } else {
                console.error("Erro ao enviar mensagem:", xrm.statusText);
            }
        }
    };

    let formData = new FormData(form);
    xrm.send(formData);
};




