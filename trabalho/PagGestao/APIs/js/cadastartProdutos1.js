function guardarValor() {
    var nomedoProduto = document.getElementById("nomeProduto").value;
    var precoProduto = document.getElementById("precoProduto").value;
    var quantidadeProduto = document.getElementById('quantidadePrdutos').value;

    if (nomedoProduto === '' || precoProduto === '' || quantidadeProduto === '') {
        alert('Preencha os dados!');
        return;
    }

    var formData = new FormData();
    formData.append('nomeProduto', nomedoProduto);
    formData.append('precoProduto', precoProduto);
    formData.append('quantidade', quantidadeProduto);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/trabalho/PagGestao/APIs/php/cadastroProduto.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                alert(xhr.responseText);
                location.reload();
            } else {
                alert('Erro no cadastro: ' + xhr.status);
            }
        }
    };

    xhr.send(formData);
}

// Certifique-se de que o jQuery foi carregado antes deste script
$(document).ready(function () {
    carregarProdutos();
});

function carregarProdutos() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/trabalho/PagGestao/APIs/php/listarProdutos.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Verifique se o elemento existe antes de definir o innerHTML
                var produtosCadastradosElement = document.getElementById('carregarTabela');
                if (produtosCadastradosElement) {
                    produtosCadastradosElement.innerHTML = xhr.responseText;
                } else {
                    console.error("Elemento 'carregarTabela' não encontrado.");
                }
            } else {
                alert('Erro ao carregar produtos: ' + xhr.status);
            }
        }
    };

    xhr.send();
}

