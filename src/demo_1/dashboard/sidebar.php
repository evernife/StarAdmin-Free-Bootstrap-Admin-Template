<?php
echo
'
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="../assets/images/profiles/faces/unkown.png" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper" align="center">
                    <p class="profile-name" id="sidebar-username" >%username%</p>
                    <p class="designation" id="sidebar-role" >%role%</p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">Analytics Dashboard</li>
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#analises-arima" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Analise ARIMA</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="analises-arima">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="?action=new_arima">Fazer Nova Análise</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=arima_history">Ver Histórico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=arima_help"> <span class="mdi mdi-information" style="color: #ffffff"><span> Como Funciona?</a>
                    </li>
                </ul>
            </div>
        </li>
        ';
if (isset($_SESSION['ADMIN'])){
    echo '
        <li class="nav-item">
            <a class="nav-link" href="?action=accounts">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Ver Contas Registradas</span>
            </a>
        </li>
    ';
}
echo '
        <li class="nav-item">
            <a class="nav-link" href="?action=hardcoded">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">HardCoded Example</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://github.com/evernife/StarAdmin-Free-Bootstrap-Admin-Template/tree/master/src/demo_1">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">GitHUB Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://github.com/evernife/TCC-BigData-Analytics">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">GitHUB Python-API</span>
            </a>
        </li>
    </ul>
</nav>
'
?>
