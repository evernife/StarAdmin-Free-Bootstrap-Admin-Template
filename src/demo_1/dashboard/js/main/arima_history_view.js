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

class FCTimeFrame{
    constructor(millis){
        this.date = new Date(parseInt(millis));
        this.day = this.date.getUTCDate();
        this.month = this.date.getUTCMonth() + 1;
        this.year = this.date.getUTCFullYear();
    }
    getFormated(){
        return this.year + "/" + this.month + "/" + this.day;
    }
}

class DataSet{
    constructor(id, name, button, timeList, valueList, allValues) {
        this.id = id;
        this.name = name;
        this.button = button;
        this.timeList = timeList;
        this.valueList = valueList;
        this.allValues = allValues;
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
    var allValues = []
    for (var key in json_data["original"]) {
        timeList.push(key);
        var aValue = json_data["original"][key];
        valueList.push(aValue)
        allValues.push({
            "date": new FCTimeFrame(key).getFormated(),
            "value": aValue
        })
    }
    dataset_array.push(new DataSet(0,"Real",the_button,timeList,valueList,allValues));
}


function createButton(key) {
    var the_buttons = document.getElementById("the-buttons");
    var original_data_button = document.getElementById("original-data");
    var new_button = original_data_button.cloneNode(true);
    new_button.id = "button-" + key;
    new_button.innerHTML = "Dados: " + key;
    the_buttons.appendChild(document.createElement("br"));
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
        var allValues = []

        var entrySet = json_data["data"][i]["value"];
        for (var key in entrySet) {
            timeList.push(key);
            var aValue = entrySet[key];
            valueList.push(aValue)
            allValues.push({
                "date": new FCTimeFrame(key).getFormated(),
                "value": aValue
            })
        }
        datasets_count++;
        dataset_array.push(new DataSet(datasets_count - 1,json_data["data"][i]["name"],the_button,timeList,valueList, allValues));
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
        var fcTimeFrame = new FCTimeFrame(time);
        var newLabel;
        if (PERIOD == 1){
            newLabel = fcTimeFrame.getFormated();
        }else if (MONTHLY){
            newLabel = MONTHS[fcTimeFrame.month] + " - " + fcTimeFrame.year ;
        }else {
            newLabel = fcTimeFrame.year ;
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
        var d1 = new Date(time), //Java Script usa Segundos, nao millis
            m = d1.getUTCMonth() + 1,
            y = d1.getUTCFullYear();
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

//----------------------------------------------------------------------
// New Code Below
//----------------------------------------------------------------------

am4core.ready(function() {

// Themes begin
    am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
    var chart = am4core.create("chartdiv", am4charts.XYChart);

// Set input format for the dates
    chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

// Create axes
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
    var series = chart.series.push(new am4charts.LineSeries());
    series.name = "Real";
    series.data = dataset_array[0].allValues;
    series.dataFields.valueY = "value";
    series.dataFields.dateX = "date";
    series.tooltipText = "Real {value}"
    series.strokeWidth = 2;
    series.minBulletDistance = 15;

// Drop-shaped tooltips
    series.tooltip.background.cornerRadius = 20;
    series.tooltip.background.strokeOpacity = 0;
    series.tooltip.pointerOrientation = "vertical";
    series.tooltip.label.minWidth = 40;
    series.tooltip.label.minHeight = 40;
    series.tooltip.label.textAlign = "middle";
    series.tooltip.label.textValign = "middle";

// Make bullets grow on hover
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.strokeWidth = 2;
    bullet.circle.radius = 4;
    bullet.circle.fill = am4core.color("#fff");

    var bullethover = bullet.states.create("hover");
    bullethover.properties.scale = 1.3;

// Make a panning cursor
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.behavior = "panXY";
    chart.cursor.xAxis = dateAxis;
    chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
    chart.scrollbarY = new am4core.Scrollbar();
    chart.scrollbarY.parent = chart.leftAxesContainer;
    chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);
    chart.scrollbarX.parent = chart.bottomAxesContainer;

    dateAxis.start = 0;
    dateAxis.keepSelection = true;

    // Add cursor
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.xAxis = dateAxis;
    chart.cursor.snapToSeries = [series];

    chart.legend = new am4charts.Legend();
    chart.legend.position = "right";
    chart.legend.scrollable = true;

    chart.legend.itemContainers.template.events.on("over", function(event) {
        processOver(event.target.dataItem.dataContext);
    })

    chart.legend.itemContainers.template.events.on("out", function(event) {
        processOut(event.target.dataItem.dataContext);
    })

    function processOver(hoveredSeries) {
        hoveredSeries.toFront();

        hoveredSeries.segments.each(function(segment) {
            segment.setState("hover");
        })

        chart.series.each(function(series) {
            if (series != hoveredSeries) {
                series.segments.each(function(segment) {
                    segment.setState("dimmed");
                })
                series.bulletsContainer.setState("dimmed");
            }
        });
    }

    function processOut(hoveredSeries) {
        chart.series.each(function(series) {
            series.segments.each(function(segment) {
                segment.setState("default");
            })
            series.bulletsContainer.setState("default");
        });
    }
// Create the same as above for all other series

    for (i = 1; i < dataset_array.length; i++){
        var dataset = dataset_array[i];
        var aSerie = chart.series.push(new am4charts.LineSeries());
        aSerie.data = dataset.allValues;
        aSerie.name = "#" + dataset.name;

        aSerie.dataFields.valueY = "value";
        aSerie.dataFields.dateX = "date";
        aSerie.tooltipText = "{name}: [bold]{value}[/]"
        aSerie.strokeWidth = 1;
        aSerie.minBulletDistance = 15;

        aSerie.tooltip.background.cornerRadius = 5;
        aSerie.tooltip.background.strokeOpacity = 0;
        aSerie.tooltip.pointerOrientation = "vertical";
        aSerie.tooltip.label.minWidth = 20;
        aSerie.tooltip.label.minHeight = 20;
        aSerie.tooltip.label.textAlign = "middle";
        aSerie.tooltip.label.textValign = "middle";

        chart.cursor.snapToSeries.push(aSerie);


        var bullet = aSerie.bullets.push(new am4charts.CircleBullet());
        bullet.circle.strokeWidth = 1;
        bullet.circle.radius = 2;
        bullet.circle.fill = am4core.color("#fff");

        var bullethover = bullet.states.create("hover");
        bullethover.properties.scale = 1.3;
    }

    chart.cursor.snapToSeries.forEach(series => {
        var segment = series.segments.template;
        segment.interactionsEnabled = true;

        var hoverState = segment.states.create("hover");
        hoverState.properties.strokeWidth = 3;

        var dimmed = segment.states.create("dimmed");
        dimmed.properties.stroke = am4core.color("#dadada");

        segment.events.on("over", function(event) {
            processOver(event.target.parent.parent.parent);
        });

        segment.events.on("out", function(event) {
            processOut(event.target.parent.parent.parent);
        });
    })
}); // end am4core.ready()