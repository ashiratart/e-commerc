// login.js
async function encorntar() {
    console.log("Elemento login:", document.getElementById("login"));

    var usuario = document.getElementById("login").value;
    var senha = document.getElementById("senha").value;
    console.log("Usuario", usuario, "Senha", senha);

    try {
        // Faz a requisição usando a API Fetch
        const response = await fetch("/trabalho/PagClientes/php/Cadastro/login.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `usuario=${encodeURIComponent(usuario)}&senha=${encodeURIComponent(senha)}`,
        });

        // Verifica se a resposta foi bem-sucedida
        if (response.ok) {
            const resposta = await response.json();

            
if (resposta.autenticado) {
    // Exibe mensagem de sucesso
    document.getElementById("mensagem").innerText = "Login bem-sucedido. Redirecionando...";
    
    // Armazena o nome do usuário e ID no localStorage
    localStorage.setItem('nomeUsuario', usuario);
    localStorage.setItem('idUsuario', resposta.id); // Certifique-se de que sua resposta JSON inclua o ID do usuário

    // Redireciona para outra página após o login (simulação)
    setTimeout(function () {
        window.location.href = '/trabalho/PagClientes/Clientes1.html';
    }, 2000); // Redireciona após 2 segundos (simulação)
} else {
                // Exibe mensagem de erro
                document.getElementById("mensagem").innerText = "Credenciais inválidas. Tente novamente.";
            }
        } else {
            // Exibe mensagem de erro se a resposta não for bem-sucedida
            console.error('Erro ao fazer a requisição:', response.status, response.statusText);
        }
    } catch (error) {
        // Trata erros de rede ou outros erros
        console.error('Erro ao fazer a requisição:', error.message);
    }
}