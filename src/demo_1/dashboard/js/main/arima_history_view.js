if (true) {


    var MAX_TICK = 1000;
    var STEP_SIZE = 25;
    var MONTHLY = true;
    var PERIOD = 12;

    if (json_data.hasOwnProperty("config")){
        if (json_data["config"].hasOwnProperty("maxTicks")) MAX_TICK = json_data["config"]["maxTicks"];
        if (json_data["config"].hasOwnProperty("stepSize")) STEP_SIZE = json_data["config"]["maxTicks"];
        if (json_data["config"].hasOwnProperty("monthly")) MONTHLY = json_data["config"]["monthly"];
        if (json_data["config"].hasOwnProperty("period")) PERIOD = json_data["config"]["period"];
    }

    var FUSO_FIX = 3600000 * 5; //5H

    var MONTHS = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

    class DataSet{
        constructor(id, button, timeList, valueList) {
            this.id = id;
            this.button = button;
            this.timeList = timeList;
            this.valueList = valueList;
        }

        addBackGroundColor(backgroundColor){
            this.backgroundColor = backgroundColor;
        }
    }

    function getDatasetFromButton(buttonReference){
        for(var k = 0; k < dataset_array.length; k++){
            var dataset = dataset_array[k];
            if (dataset.button == buttonReference){
                return dataset;
            }
        }
        return null;
    }

    datasets_count = 1;
    var dataset_array = [];

    if (true){//Dados originais são sempre obrigatórios
        var the_button = document.getElementById("original-data");
        var timeList = [];
        var valueList = [];
        for (var key in json_data["original"]) {
            timeList.push(key);
            valueList.push(json_data["original"][key])
        }
        dataset_array.push(new DataSet(0,the_button,timeList,valueList));
    }


    function createButton(key) {
        var the_buttons = document.getElementById("the-buttons");
        var original_data_button = document.getElementById("original-data");
        var new_button = original_data_button.cloneNode(true);
        new_button.id = "button-" + key;
        new_button.innerHTML = "Dados: " + key;
        the_buttons.appendChild(new_button);
        the_buttons.appendChild(document.createElement("br"));
        return new_button;
    }

    for (i = 0; i < json_data["data"].length; i++){//Verifica todos os dados extras!
        var type = json_data["data"][i]["type"];
        if (type == "normal"){
            var the_button = createButton(json_data["data"][i]["name"]);
            var timeList = [];
            var valueList = [];

            var entrySet = json_data["data"][i]["value"];
            for (var key in entrySet) {
                timeList.push(key);
                valueList.push(entrySet[key])
            }
            datasets_count++;
            dataset_array.push(new DataSet(datasets_count - 1,the_button,timeList,valueList));
        }
    }

    function getRandomColor() {
        var color = Math.floor(Math.random() * 16777216).toString(16);
        return '#000000'.slice(0, -color.length) + color;
    }

    var salesChartCanvas = $("#sales-statistics-overview").get(0).getContext("2d");
    for (i = 0; i < datasets_count; i++){
        var gradientStrokeFill = salesChartCanvas.createLinearGradient(0, 0, 0, 450);
        gradientStrokeFill.addColorStop(1, 'rgba(255,255,255, 0.0)');
        gradientStrokeFill.addColorStop(0, getRandomColor());
        dataset_array[i].addBackGroundColor(gradientStrokeFill)
    }

    var labelsArray = [];


    for (var j = 0; j < dataset_array.length; j++){
        var dataset = dataset_array[j];
        for (i = 0; i < dataset.timeList.length; i++){
            var time = dataset.timeList[i];
            var d1 = new Date(parseInt(time) + FUSO_FIX), //Java Script usa Segundos, nao millis
                d = d1.getDay();
                m = d1.getMonth(),
                y = d1.getFullYear();
            var newLabel;
            if (PERIOD == 1){
                newLabel = d + "-" + m + "-" + y;
            }else if (MONTHLY){
                newLabel = MONTHS[m] + " - " + y ;
            }else {
                newLabel = y ;
            }
            if (!labelsArray.includes(newLabel)){
                labelsArray.push(newLabel);
            }
        }
    }

    var ilogical_increment = 2;
    for (i = 1; i < dataset_array.length; i++){
        var dataset = dataset_array[i];
        var foundStart = labelsArray.length;
        for (var j = 0; j < labelsArray.length; j++){
            var time = dataset.timeList[i];
            var d1 = new Date(parseInt(time) + FUSO_FIX), //Java Script usa Segundos, nao millis
                m = d1.getMonth(),
                y = d1.getFullYear();
            var newLabel = MONTHS[m] + " - " + y ;
            if (labelsArray[j] == newLabel){
                foundStart = j;
                break
            }
        }
        for (var j = 0; j <= foundStart - ilogical_increment; j++){
            dataset.valueList.unshift(null);
        }
        ilogical_increment = ilogical_increment + 1;
    }



    var areaData = {
        labels: labelsArray,
        datasets: []
    };

    for (i = 0; i < dataset_array.length; i++){
        var dataset = dataset_array[i];
        areaData.datasets.push({
            label: dataset.button.innerHTML,
            data: dataset.valueList,
            borderColor: getRandomColor(),
            backgroundColor: dataset.backgroundColor,
            borderWidth: 2
        })
    }

    var areaOptions = {
        responsive: true,
        animation: {
            animateScale: true,
            animateRotate: true
        },
        elements: {
            point: {
                radius: 4,
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
                display: true,
                ticks: {
                    display: true,
                    beginAtZero: false
                },
                gridLines: {
                    drawBorder: false
                }
            }],
            yAxes: [{
                ticks: {
                    max: MAX_TICK,
                    min: 0,
                    stepSize: STEP_SIZE,
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

    for (i = 0; i < dataset_array.length; i++){
        var dataset = dataset_array[i];
        console.log("Adding button listener to " + dataset.button.innerHTML);
        dataset.button.addEventListener("click", function(){
            var innerDataset = getDatasetFromButton(this);
            var data = salesChart.data;
            if (data.datasets[innerDataset.id].data.length > 0){
                data.datasets[innerDataset.id].data = [];
            }else {
                data.datasets[innerDataset.id].data = innerDataset.valueList;
            }
            salesChart.update();
        });
    }

    console.log("Final")
    /*
    var button_id = "#" + datasett.button.id;
    console.log(button_id)
    $(button_id).click(function () {
        console.log(dataset);

    });

     */

}