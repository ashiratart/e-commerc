$(document).ready(function () {
    carregarProdutos();
});

function carregarProdutos() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/trabalho/PagGestao/APIs/php/buscarClientes.php', true);

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
