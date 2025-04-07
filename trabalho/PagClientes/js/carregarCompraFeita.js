$(document).ready(function () {
    CompraRealizada();
});

//pucaxar compras
function CompraRealizada() {
    var idSalvo = localStorage.getItem('idUsuario');

    if (idSalvo) {
        $.ajax({
            type: 'POST',
            url: '/trabalho/PagClientes/php/Compra/compra_feita.php',
            data: { id: idSalvo },
            dataType: 'json',
            success: function (response) {
                if (response && response.length > 0) {
                    montarTabela2(response);

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

//montar tabela de compras realizadas
function montarTabela2(data) {
    var tableContent = "<table>" +
        "<tr>" +
        "<th>ID</th>" +
        "<th>Produto</th>" +
        "<th>Quantidade</th>" +
        "<th>Total</th>" +
        "<th>Data da Compra</th>"
        "</tr>";

    for (var i = 0; i < data.length; i++) {
        var total2 = (parseFloat(data[i].preco) * parseInt(data[i].quantidade)).toFixed(2);
        tableContent += "<tr>" +
            "<td>" + data[i].id + "</td>" +
            "<td>" + data[i].produto_nome + "</td>" +
            "<td>" + data[i].quantidade + "</td>" +
            "<td>" + total2 + "</td>" +
            "<td>" + data[i].data_da_compra + "</td>"
            "</tr>";
    }

    tableContent += "</table>";
    $('.compraprocessada').html(tableContent);
}