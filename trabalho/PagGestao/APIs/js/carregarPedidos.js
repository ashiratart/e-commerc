$(document).ready(function () {
    pedidos();
});

function pedidos() {

    $.ajax({
        type: 'POST',
        url: '/trabalho/PagGestao/APIs/php/pedidos.php',
        dataType: 'json',
        success: function (response) {
            if (response && response.length > 0) {
                montarTabela(response);
            } else {
                console.error('Nenhum resultado retornado do servidor.');
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
}

function montarTabela(data) {
    var tableContent = "<table>" +
        "<tr>" +
        "<th>ID</th>" +
        "<th>Nome</th>" +
        "<th>CPF</th>" +
        "<th>Email</th>" +
        "<th>Pedido</th>" +
        "<th>Quantidade</th>" +
        "<th>Total</th>" +
        "<th>Data</th>" +
        "<th>Pagamento</th>" +
        "<th>Ação</th>" +
        "</tr>";

    for (var i = 0; i < data.length; i++) {
        var total = (parseFloat(data[i].preco) * parseInt(data[i].quantidade)).toFixed(2);
        tableContent += "<tr>" +
            "<td>" + data[i].id + "</td>" +
            "<td>" + data[i].nome + "</td>" +
            "<td>" + data[i].cpf + "</td>" +
            "<td>" + data[i].email_cadastrado + "</td>" +
            "<td>" + data[i].produto_nome + "</td>" +
            "<td>" + data[i].quantidade + "</td>" +
            "<td>" + total + "</td>" +
            "<td>" + data[i].data_da_compra + "</td>" +
            "<td>" + data[i].pagamento + "</td>" +
            "<td>" + data[i].status_compra + "</td>"+
            "<td>" +
            "<button onclick=\"enviarPedido(this, 'SIM')\">SIM</button>" +
            "<button onclick=\"enviarPedido(this, 'Cancela')\">Cancela</button>" +
            "</td>" +
            "</tr>";
    }

    tableContent += "</table>";
    $('.compras').html(tableContent);
}


function enviarPedido(botao, acao) {
    // Obtém a linha correspondente ao botão clicado
    var linha = botao.parentNode.parentNode;

    // Obtém o ID da linha (supondo que o ID esteja na primeira célula)
    var id = linha.cells[0].innerText;

    // Exemplo: exibe informações no console
    console.log("ID:", id);
    console.log("Ação:", acao);

     $.ajax({
        type: 'POST',
        url: '/trabalho/PagGestao/APIs/php/processarPedido.php',
        data: { id: id, acao: acao },
        dataType: 'json',
        success: function (response) {
            console.log(response);
            location.reload();
        },
        error: function (error) {
            console.error(error);
        }
    }); 
}
