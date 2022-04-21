<?php
include('includes/config.php');
if(@$_GET['modulo'] === 'novaOS'){
    include_once('includes/paginas/novaos.php');
}elseif(@$_GET['modulo'] === 'listarOS'){
    include_once('includes/paginas/listaros.php');
}elseif(@$_GET['modulo'] === 'historicoOS'){
    include_once('includes/paginas/historicoos.php');
}elseif(@$_GET['modulo'] === 'restrito'){
    include_once('includes/paginas/restrito.php');
}else{
    include_once('includes/paginas/novaos.php');
    $linkNovaOs = 'active';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Help-Desk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Help-Desk">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="<?php echo $url; ?>/help-desk/css/helpdesk.css" rel="stylesheet">
        <link href="<?php echo $url; ?>/help-desk/chosen/chosen.min.css" type="text/css" rel="stylesheet"/>
        <?php
        if(@$_GET['modulo'] === 'listarOS'){
            echo "
            <style media='screen'>
            .chosen-container-multi .chosen-choices {
                padding: 5px 5px;
                margin: 5px 0px 0px 0px;
                display: inline-block;
                border: 1px solid #CCCCCC;
                border-radius: 4px;
                box-sizing: border-box;
                color: #5F6F81;
                font-family: 'Questrial', sans-serif;
                font-size: 1em;
            }
            </style>
            ";
        }
        ?>
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="">Help-Desk</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </header>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>MODULOS</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?php if(@$_GET['modulo'] === 'novaOS') { echo 'active'; } elseif(@$linkNovaOs) { echo $linkNovaOs; } ?>" href="<?php echo $url; ?>/help-desk/?modulo=novaOS">
                                    <span class="material-icons-outlined">support</span>
                                    Nova O.S.
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(@$_GET['modulo'] === 'listarOS') { echo 'active'; } ?>" href="<?php echo $url; ?>/help-desk/?modulo=listarOS">
                                    <span class="material-icons-outlined">grading</span>
                                    Listar O.S.
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(@$_GET['modulo'] === 'historicoOS') { echo 'active'; } ?>" href="<?php echo $url; ?>/help-desk/?modulo=historicoOS">
                                    <span class="material-icons-outlined">storage</span>
                                    Histórico de O.S.
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>ADMINISTRAÇÃO</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?php if(@$_GET['modulo'] === 'restrito') { echo 'active'; } ?>" href="<?php echo $url; ?>/help-desk/?modulo=restrito">
                                    <span class="material-icons-outlined">admin_panel_settings</span>
                                    Restrito
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php
                if(@$_GET['modulo'] === 'novaOS'){
                    include_once('paginas/novaos.php');
                }elseif(@$_GET['modulo'] === 'listarOS'){
                    include_once('paginas/listaros.php');
                }elseif(@$_GET['modulo'] === 'historicoOS'){
                    include_once('paginas/historicoos.php');
                }elseif(@$_GET['modulo'] === 'restrito'){
                    include_once('paginas/restrito.php');
                }else{
                    include_once('paginas/novaos.php');
                }
                ?>
            </div>
        </div>
    </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo $url; ?>/help-desk/chosen/chosen.jquery.min.js"></script>
<?php
if(@$_GET['modulo'] === 'novaOS'){
    include_once('js/paginas/novaos.php');
}elseif(@$_GET['modulo'] === 'listarOS'){
    include_once('js/paginas/listaros.php');
}elseif(@$_GET['modulo'] === 'historicoOS'){
    include_once('js/paginas/historicoos.php');
}elseif(@$_GET['modulo'] === 'restrito'){
    include_once('js/paginas/restrito.php');
}else{
    include_once('js/paginas/novaos.php');
}
?>
</html>