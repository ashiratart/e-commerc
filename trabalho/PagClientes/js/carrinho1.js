$(document).ready(function () {
    realizarCompra();
});

function realizarCompra(callback) {
    var idSalvo = localStorage.getItem('idUsuario');

    if (idSalvo) {
        $.ajax({
            type: 'POST',
            url: '/trabalho/PagClientes/php/Carrinho/carrinho.php',
            data: { id: idSalvo },
            dataType: 'json',
            success: function (response) {
                if (response && response.length > 0) {
                    montarTabela(response);
                    calcularTotal(response);
                    obterIdsItens(response);
                    quant(response);

                    if (typeof callback === 'function') {
                        callback(response);
                    }
                } else {
                    console.error('Nenhum resultado retornado do servidor.');
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    } else {
        console.error('ID não encontrado no localStorage.');
    }
}

function montarTabela(data) {
    var tableContent = "<table>" +
        "<tr>" +
        "<th>ID</th>" +
        "<th>Produto</th>" +
        "<th>Quantidade</th>" +
        "<th>Total</th>" +
        "</tr>";

    for (var i = 0; i < data.length; i++) {
        var total = (parseFloat(data[i].preco) * parseInt(data[i].quantidade)).toFixed(2);
        tableContent += "<tr>" +
            "<td " + "class =" + "item-id" + ">" + data[i].id + "</td>" +
            "<td>" + data[i].produto_nome + "</td>" +
            "<td>" + data[i].quantidade + "</td>" +
            "<td>" + total + "</td>" +
            "</tr>";
    }

    tableContent += "</table>";
    $('.carrinhocarregado').html(tableContent);
    calcularTotal(data);
}

function calcularTotal(data) {
    var totalCompra = 0;

    for (var i = 0; i < data.length; i++) {
        totalCompra += parseFloat(data[i].preco) * parseInt(data[i].quantidade);
    }

    $('#TotaldaCompra').val("R$" + totalCompra.toFixed(2));
}

function AlterarItens() {
    var idCliente = localStorage.getItem('idUsuario');

    var opcao = prompt("O que deseja fazer?\n1 - Remover Produto do Carrinho\n2 - Alterar quantidade do item");

    if (opcao === "1" || opcao.toLowerCase() === "remover") {
        var idProdutoRemover = prompt("Informe o ID do produto que deseja remover:");
        enviarAcao('remover', idCliente, idProdutoRemover);
    } else if (opcao === "2" || opcao.toLowerCase() === "alterar") {
        var idProdutoAlterar = prompt("Informe o ID do produto que deseja alterar:");
        var novaQuantidade = prompt("Informe a nova quantidade:");
        enviarAcao('alterar', idCliente, idProdutoAlterar, novaQuantidade);
    } else {
        alert("Opção inválida");
    }
}

function enviarAcao(acao, idCliente, idProduto, novaQuantidade) {
    $.ajax({
        type: 'POST',
        url: '/trabalho/PagClientes/php/Carrinho/alterar_carrinho.php',
        data: {
            action: acao,
            idCliente: idCliente,
            idProduto: idProduto,
            novaQuantidade: novaQuantidade
        },
        success: function (response) {
            console.log(response);
            realizarCompra();
        },
        error: function (error) {
            console.error(error);
        }
    });
}

function obterIdsItens(data) {
    return data.map(function (item) {
        return item.produto_id_nome;
    });
}

function quant(data){
    return data.map(function (item) {
        return item.quantidade;
    });
}


function comprar() {
    var idCliente = localStorage.getItem('idUsuario');
    var totalCompra = $('#TotaldaCompra').val();

    // Verificar se pelo menos uma forma de pagamento foi selecionada
    var formasPagamentoSelecionadas = obterFormaPagamentoSelecionada();
    if (formasPagamentoSelecionadas.length === 0) {
        alert("Selecione pelo menos uma forma de pagamento antes de prosseguir.");
        return;
    }

    realizarCompra(function (data) {
        var idsItens = obterIdsItens(data).join(',');
        var quantidades = quant(data).join(',');
        enviarDadosCompra(idCliente, idsItens, totalCompra, formasPagamentoSelecionadas, quantidades);

        console.log("Formas de Pagamento:", formasPagamentoSelecionadas);

        console.log("IDs dos Itens:", idsItens);
        console.log("Quantidades salvas", quantidades);
    });
}


function obterFormaPagamentoSelecionada() {
    var formasPagamento = [];
    $('#formadePagamento input:checked').each(function () {
        formasPagamento.push($(this).attr('name'));
    });
    return formasPagamento;
}


function enviarDadosCompra(idCliente, idsItens, totalCompra, formasPagamentoSelecionadas, quantidades) {
    $.ajax({
        type: 'POST',
        url: '/trabalho/PagClientes/php/Compra/processar_compra.php',
        data: {
            idCliente: idCliente,
            idsItens: idsItens,
            totalCompra: totalCompra,
            formasPagamentoSelecionadas: formasPagamentoSelecionadas,
            quantidades: quantidades
        },
        success: function (response) {
            console.log(response);
            limparCarrinho(idCliente);
            MensageErecarregament();
        },
        error: function (error) {
            console.error(error);
        }
    });
}

//limpar carrinho
function limparCarrinho(idCliente) {
    $.ajax({
        type: 'POST',
        url: "/trabalho/PagClientes/php/Compra/limpar_carrinho.php",
        data: {
            idCliente: idCliente
        },
        success: function (response) {
            console.log(response);
            // Adicione qualquer lógica adicional aqui, se necessário
        },
        error: function (error) {
            console.error(error);
        }
    });
}

//Mensagem de confirmacao de compra e nova tabela de itens comprados:
function MensageErecarregament() {
    alert("Compra realizada com sucesso. Em breve nossa equipe estará enviando um email de confirmação. Obrigado pela compra!");
    location.reload();
}