if ($('#sales-statistics-overview').length) {
    var salesChartCanvas = $("#sales-statistics-overview").get(0).getContext("2d");
    var gradientStrokeFill_1 = salesChartCanvas.createLinearGradient(0, 0, 0, 450);
    gradientStrokeFill_1.addColorStop(1, 'rgba(255,255,255, 0.0)');
    gradientStrokeFill_1.addColorStop(0, 'rgba(102,78,235, 0.2)');
    var gradientStrokeFill_2 = salesChartCanvas.createLinearGradient(0, 0, 0, 400);
    gradientStrokeFill_2.addColorStop(1, 'rgba(255, 255, 255, 0.01)');
    gradientStrokeFill_2.addColorStop(0, '#14c671');

    var data_1_1 = [];
    var data_1_2 = [];

    for (i = data_input.length - 25; i < data_input.length - 12; i++){
        data_1_1.push(data_input[i]["Value"])
        //data_1_2.push(null)
    }
  //  data_1_2.pop()
    for (i = 0; i < data_predict.length; i++){
        data_1_2.push(data_predict[i]["Value"])
    }

    var labelsSize = data_input.length// + data_predict.length;
    var labelsArray = [];
    for (i = 0; i < 24; i++){
        labelsArray.push(i.toString())
    }
    var areaData = {
        labels: labelsArray,
        datasets: [{
            label: 'Penultimo Ano',
            data: data_1_1,
            borderColor: infoColor,
            backgroundColor: gradientStrokeFill_1,
            borderWidth: 2
        }, {
            label: 'Dois anos Seguintes',
            data: data_1_2,
            borderColor: successColor,
            backgroundColor: gradientStrokeFill_2,
            borderWidth: 2
        }]
    };
    var areaOptions = {
        responsive: true,
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            point: {
                radius: 3,
                backgroundColor: "#fff"
            },
            line: {
                tension: 0
            }
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        legend: false,
        legendCallback: function (chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
                console.log(chart.data.datasets[i]); // see what's inside the obj.
                text.push('<li>');
                text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                text.push(chart.data.datasets[i].label);
                text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
        },
        scales: {
            xAxes: [{
                display: false,
                ticks: {
                    display: false,
                    beginAtZero: false
                },
                gridLines: {
                    drawBorder: false
                }
            }],
            yAxes: [{
                ticks: {
                    max: 500,
                    min: 0,
                    stepSize: 50,
                    fontColor: "#858585",
                    beginAtZero: false
                },
                gridLines: {
                    color: '#e2e6ec',
                    display: true,
                    drawBorder: false
                }
            }]
        }
    }
    var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
    });
    document.getElementById('sales-statistics-legend').innerHTML = salesChart.generateLegend();

    $("#sales-statistics_switch_1").click(function () {
        var data = salesChart.data;
        data.datasets[0].data = data_1_1;
        data.datasets[1].data = data_1_2;
        salesChart.update();
    });
}