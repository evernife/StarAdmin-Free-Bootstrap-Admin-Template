<?php
$file = 'data/'.$_SESSION["username"]."/".$_SESSION["file"];
?>
<?php if (true): ?>
    <div class="content-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">ARIMA Analytics</h4>
                    <div class="d-flex flex-column flex-lg-row">
                        <p>File: <?=$file?></p>
                    </div>

                    <div id="the-buttons">
                        <button type="button" class="btn btn-primary btn-fw" id="original-data">Dados Originais</button>
                        <br>
                    </div>

                    <div class="d-flex flex-column flex-lg-row">
                        <div id="sales-statistics-legend"></div>
                    </div>
                    <div class="d-flex flex-column flex-lg-row">
                    </div>
                    <canvas class="mt-5" height="120" id="sales-statistics-overview"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card average-price-card">
            <div class="card text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 align-items-center">
                        <h2 class="font-weight-semibold mb-0" >%value%</h2>
                        <div class="icon-holder">
                            <i class="mdi mdi-trending-up"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 class="font-weight-semibold mb-0">AIC</h5>
                        <p class="text-white mb-0">Critério de informação de Akaike</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">ARIMA Analytics</h4>
                    <div class="d-flex flex-column flex-lg-row">
                        <p>File: <?=$file?></p>
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
<?php endif; ?>