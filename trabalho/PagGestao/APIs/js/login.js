// login.js

function entartaqui() {
    var usuario = document.getElementById("user").value;
    var senha = document.getElementById("senha").value;

    // Simula a autenticação do lado do servidor
    // Suponha que as credenciais corretas sejam "usuarioTest" e "senhaTest"
    if (usuario === "usuarioTest" && senha === "senhaTest") {
        // Exibe mensagem de sucesso
        document.getElementById("mensagem").innerText = "Login bem-sucedido. Redirecionando...";

        // Redireciona para outra página após o login (simulação)
        setTimeout(function () {
            window.location.href = '/trabalho/PagGestao/Gestao.html';
        }, 2000); // Redireciona após 2 segundos (simulação)
    } else {
        // Exibe mensagem de erro
        document.getElementById("mensagem").innerText = "Credenciais inválidas. Tente novamente.";
    }
}
