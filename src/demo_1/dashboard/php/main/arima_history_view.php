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
                    <div class="ml-lg-auto" id="sales-statistics-legend"></div>
                </div>
                <canvas class="mt-5" height="120" id="sales-statistics-overview"></canvas>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>