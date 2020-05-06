<?php
include 'php/fcphputil.php';
$dir = 'data/'.$_SESSION["username"];
$files = getFilesIn($dir);
?>
<?php if (true): ?>
    <div class="content-wrapper">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Histórico de Análises (ARIMA)</h4>
                            <p class="card-description"> Todas as analises do usuário: <?=$_SESSION['username']?></p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nome do Arquivo</th>
                                    <th>Data.</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($files as $history_log):
                                    $filename = $dir."/".$history_log;
                                    $seconds = getExportCretionDate($filename);
                                    ?>
                                    <tr>
                                        <td><?=$history_log?></td>
                                        <td><?=date("d m Y H:i:s.", $seconds)?></td>
                                        <td>
                                            <label class="badge badge-primary">Completo</label>
                                        </td>
                                        <td>
                                            <button onclick="window.open('dashboard.php?action=arima_history&file=<?=$history_log?>')" type="button" class="btn btn-info btn-fw">Inspecionar Análise</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>