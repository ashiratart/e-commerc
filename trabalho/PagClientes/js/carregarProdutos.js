// Carregar Produtos
$(document).ready(function () {
    //Obter Primeiro usuario
    //carregar pagina
    carregarProdutos();
});

// Definir as funções globalmente
function comprar(idProduto) {
    var idUsuario = localStorage.getItem("idUsuario");

    // Obter a quantidade do produto do localStorage usando a chave "MeuProduto"
    var quantidadeProduto = parseFloat(JSON.parse(localStorage.getItem("MeuProduto")));

    // Verificar se a quantidade existe e é um número válido
    if (!isNaN(quantidadeProduto)) {
        // Salvar o ID do produto e a quantidade no localStorage e enviar para o servidor
        salvarIdProdutoQuantidadeLocalStorageEEnviar(idProduto, idUsuario, quantidadeProduto);
    } else {
        console.error("A quantidade salva no localStorage não é um número válido");
    }
}

function salvarIdProdutoQuantidadeLocalStorageEEnviar(idProduto, idUsuario, quantidadeProduto) {
    // Verificar se o localStorage é suportado no navegador
    if (typeof Storage !== "undefined") {
        // Obter IDs de produtos existentes no localStorage ou inicializar um array vazio
        var idsProdutos = JSON.parse(localStorage.getItem("idsProdutos")) || [];

        // Adicionar o novo ID do produto à lista
        idsProdutos.push(idProduto);

        // Salvar a lista atualizada no localStorage
        localStorage.setItem("idsProdutos", JSON.stringify(idsProdutos));

        console.log("ID do produto salvo no localStorage: " + idProduto);

        // Enviar o ID do produto e a quantidade para o servidor via AJAX
        $.ajax({
            url: '/trabalho/PagClientes/php/Carrinho/enviarDados1.php',
            type: 'POST',
            data: { idProduto: idProduto, idUsuario: idUsuario, quantidade: quantidadeProduto.toFixed(2) },
            success: function (response) {
                console.log("ID do produto e quantidade enviados com sucesso para o servidor.");
                alert("Produto aguardando a compra no carrinho!")
                location.reload();
            },
            error: function (error) {
                console.error("Erro ao enviar ID do produto e quantidade para o servidor: ", error);
            }
        });
    } else {
        console.error("LocalStorage não suportado no navegador.");
    }
}

function carregarProdutos() {
    // Fazer uma requisição AJAX para obter os produtos do PHP
    $.ajax({
        url: '/trabalho/PagClientes/js/carregarProdutos.php',
        type: 'GET',
        dataType: 'json',
        success: function (produtosDoBancoDeDados) {
            console.log(produtosDoBancoDeDados);

            var container = $("#produtosContainer");

            for (var i = 0; i < produtosDoBancoDeDados.length; i++) {
                var produto = produtosDoBancoDeDados[i];

                // Verifica se é necessário criar uma nova div
                if (i % 3 === 0) {
                    container.append('<div class="novaDiv" id="novaDiv-' + i / 3 + '"></div>');
                }

                // Adiciona o produto à última div criada
                var novaDiv = container.find('.novaDiv').last();
                novaDiv.append(
                    '<div id="produtosCadastrados-' + produto.id + '" data-id="' + produto.id + '">' +
                    '<img src="/trabalho/uploads/' + extrairCaminhoRelativo(produto.img) + '" alt="Imagem do produto">' +
                    '<h1>' + produto.nome + '</h1>' +
                    '<p>' + '<span> R$ </span>' + produto.preco + '</p>' +
                    '<input type="number" class="quantidadedoProduto" data-id="' + produto.id + '" min="0" max="' + produto.quantidadeEstoque + '" oninput="monitorarQuantidade(this)">' +
                    '<button id="poduto(' + produto.id + ')" type="button" onclick="comprar(' + produto.id + ')">Comprar</button>' +
                    '</div>'
                );
            }
        }
    });
}

function monitorarQuantidade(inputQuantidade) {
    var valorQuantidade = $(inputQuantidade).prop('valueAsNumber');

    if (!isNaN(valorQuantidade)) {
        // Obter a chave do localStorage
        var chaveLocalStorage = "MeuProduto";

        // Obter os valores atuais do localStorage ou inicializar um array vazio
        var valoresAnteriores = JSON.parse(localStorage.getItem(chaveLocalStorage)) || [];

        // Substituir completamente o array anterior pelo novo valor
        valoresAnteriores = [valorQuantidade];

        // Salvar o array atualizado no localStorage
        localStorage.setItem(chaveLocalStorage, JSON.stringify(valoresAnteriores));

        console.log("Valor do input de quantidade atualizado e salvo temporariamente: " + valorQuantidade);
    } else {
        console.error("O valor do input de quantidade não é um número válido");
    }
}

function extrairCaminhoRelativo(caminhoCompleto) {
    // Excluir a parte inicial do caminho mantendo o restante
    return caminhoCompleto.substring(caminhoCompleto.indexOf('/trabalho/uploads/') + '/trabalho/uploads/'.length);
}
