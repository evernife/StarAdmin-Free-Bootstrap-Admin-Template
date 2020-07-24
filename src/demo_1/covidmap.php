<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CovidMap</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        #map {
            width: 100%;
            height: 600px;
        }
        .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; }
    </style>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

</head>
<body>
<div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand brand-logo" href="/">
                <img src="../assets/images/fc-small-logo-reverse.png" alt="logo" /> </a>
            <a class="navbar-brand brand-logo-mini" href="/">
                <img src="../assets/images/logo-mini.svg" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block">Contato: petrus.pradella@unesp.br</li>
            </ul>
            <form class="ml-auto search-form d-none d-md-block" action="#">
                <div class="form-group">
                    <input type="search" class="form-control" placeholder="Pesquisar nome de Cidade" disabled>
                </div>
            </form>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link" id="perfil">
                        <div class="profile-image">
                            <img class="img-xs rounded-circle" src="../assets/images/profiles/faces/unkown.png" alt="profile image">
                            <div class="dot-indicator bg-success"></div>
                        </div>
                        <div class="text-wrapper" align="center">
                            <p class="profile-name" id="sidebar-username" >UNESP</p>
                            <p class="designation" id="sidebar-role" ></p>
                        </div>
                    </a>
                </li>
                <li class="nav-item nav-category">CovidMap Viwer</li>
                <li class="nav-item">
                    <a class="nav-link" href="http://tcc.finalcraft.com.br">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title"><del>Ir para o Dashboard</del></span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="main-panel">

            <div class="content-wrapper">
                <div id="map"></div>
            </div>

            <div class="content-wrapper" id="city-viwer">
                <div class="col-md-6 grid-margin stretch-card average-price-card">
                    <div class="card text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2 align-items-center">
                                <h2 class="font-weight-semibold mb-0" id="aic">%value%</h2>
                                <div class="icon-holder">
                                    <a href="http://arquivo.ufv.br/dbg/resumos2008b/Resumo%20Claudomiro.htm"><i class="mdi mdi-trending-up"></i></a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="font-weight-semibold mb-0">AIC</h5>
                                <p class="text-white mb-0">Critério de informação de Akaike</p>
                            </div>
                        </div>
                    </div>
                    <div class="card text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2 align-items-center">
                                <h2 class="font-weight-semibold mb-0" id="bic">%value%</h2>
                                <div class="icon-holder">
                                    <a href="http://arquivo.ufv.br/dbg/resumos2008b/Resumo%20Claudomiro.htm"><i class="mdi mdi-trending-up"></i></a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="font-weight-semibold mb-0">BIC</h5>
                                <p class="text-white mb-0">Critério Bayesiano de Schwarz</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">ARIMA Analytics</h4>
                            <div class="d-flex flex-column flex-lg-row">
                            </div>
                            <div id="chartdiv"></div>
                        </div>
                    </div>
                </div>

            </div>

            <style>
                #chartdiv {
                    width: 100%;
                    height: 500px;
                }
            </style>
            <script src="https://www.amcharts.com/lib/4/core.js"></script>
            <script src="https://www.amcharts.com/lib/4/charts.js"></script>
            <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        </div>
    </div>
</body>
<!-- page-body-wrapper ends -->
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="../assets/js/shared/off-canvas.js"></script>
<script src="../assets/js/shared/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../assets/js/demo_1/dashboard.js"></script>

<script>
    var loadedFile = false;
    <?php
    if (isset($_GET["city"])) {
        $file = 'cities/' . $_GET["city"] . ".json";
        try {
            echo 'var json_data = '.file_get_contents($file)."\n";
            echo 'loadedFile = true;';
        } catch (Exception $e) {
            echo 'error = \"Exceção capturada: ',  $e->getMessage(), "\"\n";
            echo 'var json_data = []';
        }
    }
    ?>

    var dataset_array = [];

    if (loadedFile == false){
        document.getElementById('city-viwer').style.display = 'none';
    } else {

        document.getElementById('aic').innerText = json_data['config']['aic'];
        document.getElementById('bic').innerText = json_data['config']['bic'];

        class FCTimeFrame{
            constructor(millis){
                this.date = new Date(parseInt(millis));
                this.day = this.date.getUTCDate();
                this.month = this.date.getUTCMonth() + 1;
                this.year = this.date.getUTCFullYear();
            }
            getFormated(){
                return this.year + "/" + this.month + "/" + (this.day < 10 ? "0" : "") + this.day;
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

        datasets_count = 1;

        the_button = "None"

        if (true){//Dados originais são sempre obrigatórios
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

        for (i = 0; i < json_data["data"].length; i++){//Verifica todos os dados extras!
            var type = json_data["data"][i]["type"];
            if (type == "normal"){
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
            series.tooltipText = "{date} - Real: {value}"
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
                aSerie.tooltipText = "{date} - {name}: [bold]{value}[/]"
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
    }
</script>
<script>

    var map = L.map('map').setView([-22.55314748, -48.49365234], 7);

    var cities_data;
    var citymap;
    var density_value = 0.2;
    $.getJSON('cities/cities_data.json').done(function(data) {
        cities_data = data;

        function getTotalDeathsOf(city_id){
            var total_deaths;
            try {
                total_deaths = cities_data[parseInt(city_id)].total_deaths;
            }catch (e) {
                total_deaths = 0;
            }
            return total_deaths;
        }

        $.getJSON('citymap.json').done(function(data){

            citymap = data;
            function getColor(d) {
                return d > 3000 * density_value ? '#36001b' :
                    d > 2000 * density_value ? '#5b0021' :
                        d > 1000 * density_value ? '#800026' :
                            d > 500 * density_value  ? '#BD0026' :
                                d > 200 * density_value  ? '#E31A1C' :
                                    d > 100 * density_value  ? '#FC4E2A' :
                                        d > 50 * density_value   ? '#FD8D3C' :
                                            d > 20 * density_value   ? '#FEB24C' :
                                                d > 10 * density_value   ? '#FED976' :
                                                    d > 0 * density_value   ? '#FED976' :
                                                        '#FFEDA0';
            }

            function style(feature) {
                return {
                    fillColor: getColor(getTotalDeathsOf(feature.properties.id)),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7
                };
            }

            var info = L.control();

            info.onAdd = function (map) {
                this._div = L.DomUtil.create('div', 'info');
                this.update();
                return this._div;
            };

            info.update = function (props) {
                this._div.innerHTML = '<h4>Death Density CovidMap / SP</h4>' +  (props ?
                    '<b>' + props.name + '</b><br />' + getTotalDeathsOf(props.id) + ' Mortes'
                    : 'Passe o mouse sobre alguma cidade');
            };

            info.addTo(map);

            function highlightFeature(e) {
                var layer = e.target;

                layer.setStyle({
                    weight: 5,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.7
                });

                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }

                info.update(layer.feature.properties);
            }

            var geojson;

            function resetHighlight(e) {
                geojson.resetStyle(e.target);
                info.update();
            }

            function zoomToFeature(e) {
                map.fitBounds(e.target.getBounds());
            }

            var popup = L.popup();
            var clickedCity
            function onMapClick(e) {
                clickedCity = e.propagatedFrom.feature.properties;
                popup
                    .setLatLng(e.latlng)
                    .setContent("Cidade selecionada: <b>" + clickedCity.name +
                        "</b><br><br>ID da Cidade: " + clickedCity.id +
                        "</b><br>Total de mortos: " + getTotalDeathsOf(clickedCity.id) +
                        "<br>Ver Grafico dessa cidade: <a href=\"?city=" + clickedCity.id + "\">Clique Aqui</a>")
                    .openOn(map);
            }


            function onEachFeature(feature, layer) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight
                });
            }

            allFeatures = L.geoJson(citymap, {
                style: style,
                onEachFeature: onEachFeature
            });
            geojson = allFeatures.addTo(map);
            allFeatures.on('click', onMapClick)
        });
    });

</script>
<!-- End custom js for this page-->

</html>