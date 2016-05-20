<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/png" href="images/kichink_favicon.png">
    <link href='https://fonts.googleapis.com/css?family=Poppins:500' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css');?>" type="text/css"/>

    <link rel="stylesheet" href="<?php echo base_url('public/bower_components/font-awesome/css/font-awesome.min.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('public/bower_components/morris.js/morris.css'); ?>">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="page-container" class="header-fixed-top sidebar-visible-lg-full">


    <!-- Main Sidebar -->
    <div id="sidebar">
        <!-- Sidebar Brand -->
        <div id="sidebar-brand" class="text-center">
            <div class="sidebar-logo">
                <img src="images/logo-light.png"/>
            </div>

            <img src="images/avatar.png"/>
            <h4 class="text-muted"><strong>Kraken piesas unicas</strong></h4>
        </div>
        <!-- END Sidebar Brand -->

        <!-- Wrapper for scrolling functionality -->
        <div id="sidebar-scroll">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <!--li>
                        <a href="{{URL::to('Panel/Panel')}}"><i class="fa fa-line-chart sidebar-nav-icon"  data-original-title="Indicadores"></i><span >Indicadores</span></a>
                    </li-->


                    <li>

                        <span class="info">
                            <i class="fa fa-circle text-success"></i>
                        </span>
                        <a href="home.html">

                            <i
                                class="fa text-info fa-lg fa-home sidebar-nav-icon"
                            ></i>
                            <span>Home</span>

                            <span class="badge bg-success pull-right notification">2</span>
                        </a>
                    </li>
                    <li>
                         <span class="info">

                        </span>
                        <a href="articulos.html">
                            <i
                                class="fa text-info fa-lg  fa-shopping-bag sidebar-nav-icon"

                            ></i><span>Articulos </span></a>
                    </li>
                    <li>
                        <span class="info">

                        </span>
                        <a href="articulos.html"><i
                                class="fa fa-lg text-info  fa-shopping-cart sidebar-nav-icon"

                            ></i><span>Ordenes </span>
                            <span class="badge bg-success pull-right notification">2</span>
                        </a>

                    </li>

                    <li>
                        <span class="info">

                        </span>
                        <a href="categorias.html">

                            <i
                                class="fa fa-lg text-info  fa-tag sidebar-nav-icon"

                            ></i><span>Categorias </span></a>
                    </li>
                    <li>
                        <span class="info">

                        </span>
                        <a href="categorias.html">

                            <i
                                class="fa fa-lg text-info  fa-tag sidebar-nav-icon"

                            ></i><span>Pagos </span></a>
                    </li>
                    <li>
                        <span class="info">

                        </span>
                        <a href="categorias.html">

                            <i
                                class="fa fa-lg text-info  fa-archive sidebar-nav-icon"

                            ></i><span>Mensaje </span></a>
                    </li>
                    <li>
                        <span class="info">

                        </span>
                        <a href="categorias.html">

                            <i
                                class="fa fa-lg text-info  fa-bar-chart sidebar-nav-icon"

                            ></i><span>Reportes </span></a>
                    </li>
                    <li>
                        <span class="info">

                        </span>
                        <a href="categorias.html">

                            <i
                                class="fa fa-lg text-info  fa-cog sidebar-nav-icon"

                            ></i><span>Ajustes </span></a>
                    </li>

                </ul>
                <!-- END Sidebar Navigation -->
            </div>
            <!-- END Sidebar Content -->
        </div>
        <!-- END Wrapper for scrolling functionality -->


    </div>
    <!-- END Main Sidebar -->


    <!-- Main Container -->
    <div id="main-container">


        <header class="navbar navbar-default navbar-fixed-top shadow-z-1-hover">
            <ul class="nav navbar-nav-custom">
                <li class="no-margin">
                    <a href="javascript:void(0)" onclick="App.toogleSidebar();">

                        <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                    </a>
                </li>

                <li class="animation-fadeInQuick">


                    <a href="javascript:" class="hidden-xs pull-right">
                        <strong>HOME</strong>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav-custom pull-right">


                <li>

                    <a href="javascript:">
                                <span class="text-default">
                                        Saldo
                                </span>
                                <span class="text-primary">
                                        $8,250
                                </span>
                    </a>

                </li>

                <li class="no-margin">
                    <a href="javascript:">
                        <span class="text-default">
                                        ¡Hola
                                </span>
                                <span class="text-primary">
                                        Craken
                                </span>
                    </a>
                </li>
                <li class="no-margin">
                    <img src="images/avatar.png"/>
                </li>
                <li class="dropdown no-margin">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-angle-down"></i>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">

                        <li>
                            <a href="javascript:">
                                Configuración
                            </a>
                        </li>

                        <li>
                            <a href="javascript:">
                                Ayuda
                            </a>
                        </li>
                        <li>
                            <a href="javascript:">
                                Salir
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </header>

        <div id="page-content">
            <?php echo $content; ?>
        </div>

    </div>
    <!-- END Main Container -->
</div>
<script src="<?php echo base_url('public/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('public/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('public/bower_components/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('public/bower_components/morris.js/morris.min.js'); ?>"></script>
<script src="<?php echo base_url('public/js/App.js'); ?>"></script>
</body>
</html>