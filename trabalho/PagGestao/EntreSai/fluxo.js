$(document).ready(function () {
    // Faça uma solicitação AJAX para obter os dados do gráfico
    $.ajax({
        url: 'caminho/para/seu/dados_grafico.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Use os dados recebidos para preencher o gráfico
            var ctx = document.getElementById('Grafico').getContext('2d');

            var meuGrafico = new Chart(ctx, {
                type: 'scatter',
                data: {
                    labels: data.map(item => item.label),
                    datasets: [{
                        type: 'line',
                        label: 'Ganhos',
                        data: data.map(item => item.ganhos),
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)'
                    }, {
                        type: 'line',
                        label: 'Perdas',
                        data: data.map(item => item.perdas),
                        fill: false,
                        borderColor: 'rgb(54, 162, 235)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
});

