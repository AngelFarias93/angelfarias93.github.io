<?php
    $rutas = array();
    if (isset($_GET["ruta"])) {
        $rutas = explode("/", $_GET["ruta"]);
        $ruta = $rutas[0];
    }
?>
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="inicio" class="brand-link">
      <img src="<?=LOGOTECSOLT?>" alt="Tecsolt" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><b>VMC</b> Distr. y Lógistica</span>
  </a>
  <!-- Sidebar -->
    <?php
    if ($_SESSION["perfil"] == "Cliente"){
        ?>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header text-bold">DASHBOARD</li>
                    <!-- INICIO -->
                    <!--<li class="nav-item">
                        <a href="<?/*=RUTA*/?>inicio" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li>-->
                    <!-- USUARIOS -->
                    <!-- TRAFICO -->
                    <!--<li class="nav-item has-treeview">
                        <a href="<?/*=RUTA*/?>trafico" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Tráfico</p>
                        </a>
                    </li>-->
                    <li class="nav-item has-treeview">
                        <a href="<?=RUTA?>productos" class="nav-link">
                            <i class="fab fa-product-hunt nav-icon"></i>
                            <p>Productos</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?=RUTA?>importacion" class="nav-link">
                            <i class="fas fa-shipping-fast nav-icon"></i>
                            <p>Importaciones</p>
                        </a>
                    </li>
                    <!-- DISTRIBUCIÓN -->
                    <li class="nav-item has-treeview">
                        <a href="<?=RUTA?>distribucion" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Distribución</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="sidebar-custom">
            <a href="#" class="btn btn-link text-white" data-toggle="modal" data-target="#modalContacto"><i class="fas fa-envelope-open-text mr-2"></i>¿Quiénes somos?</a>
        </div>
        <?php
    }else{
        ?>
        <div class="sidebar">
            <!-- Sidebar user panel (optional)
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
              </div>
            </div> -->
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header text-bold">DASHBOARD</li>
                    <!-- INICIO -->
                    <li class="nav-item">
                        <a href="<?=RUTA?>inicio" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <!-- USUARIOS -->
                    <li class="nav-item">
                        <a href="<?=RUTA?>users" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <!-- CATALOGOS -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Catálogos<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Proveedores <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>proveedores" class="nav-link">
                                            <i class="fas fa-address-book nav-icon"></i>
                                            <p>Listado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>tipoproveedores" class="nav-link">
                                            <i class="fas fa-tag nav-icon"></i>
                                            <p>Clasificación</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>caracteristicasproveedores" class="nav-link">
                                            <i class="fas fa-list-ul nav-icon"></i>
                                            <p>Características</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Clientes <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>clientes" class="nav-link">
                                            <i class="fas fa-address-book nav-icon"></i>
                                            <p>Listado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>subclientes" class="nav-link">
                                            <i class="fas fa-list-ul nav-icon"></i>
                                            <p>Sub-clientes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>origendestino" class="nav-link">
                                    <i class="fas fa-map-marked-alt nav-icon"></i>
                                    <p>Origen & Destino</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>colores" class="nav-link">
                                    <i class="fas fa-palette nav-icon"></i>
                                    <p>Colores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>transportes" class="nav-link">
                                    <i class="fas fa-truck-moving nav-icon"></i>
                                    <p>Trasportes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>numpallets" class="nav-link">
                                    <i class="fas fa-pallet nav-icon"></i>
                                    <p>Pallets</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>marcas" class="nav-link">
                                    <i class="fas fa-project-diagram nav-icon"></i>
                                    <p>Marcas</p>
                                </a>
                            </li>
                            <li class="nav-item" style="display: none">
                                <a href="<?=RUTA?>modelos" class="nav-link">
                                    <i class="fas fa-fw fa-sitemap nav-icon"></i>
                                    <p>Modelos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-boxes nav-icon"></i>
                                    <p>Inventarios <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>catproductos" class="nav-link">
                                            <i class="fas fa-list-ul nav-icon"></i>
                                            <p>Cat. Productos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>almacenes" class="nav-link">
                                            <i class="fas fa-warehouse nav-icon"></i>
                                            <p>Almacenes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>productos" class="nav-link">
                                            <i class="fab fa-product-hunt nav-icon"></i>
                                            <p>Productos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>movimientos" class="nav-link">
                                            <i class="fas fa-scanner nav-icon"></i>
                                            <p>Movimientos Inv.</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>mercancia" class="nav-link">
                                            <i class="fas fa-dolly-flatbed nav-icon"></i>
                                            <p>Recibir Mercancia</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>incidenciasmercancia" class="nav-link">
                                            <i class="fas fa-exclamation-triangle nav-icon"></i>
                                            <p>Incidencias Imeis</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>kardex" class="nav-link">
                                            <i class="fas fa-history nav-icon"></i>
                                            <p>Kardex</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>distributionOrders" class="nav-link">
                                            <i class="fas fa-asterisk nav-icon"></i>
                                            <p>Autorizar DO</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- CONTROL Y CALIDAD -->
                    <li class="nav-item has-treeview">
                        <a href="<?=RUTA?>quality" class="nav-link">
                            <i class="nav-icon fas fa-box-check"></i>
                            <p>QA</p>
                        </a>
                    </li>
                    <!-- TRAFICO -->
                    <li class="nav-item has-treeview">
                        <a href="<?=RUTA?>trafico" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Tráfico</p>
                        </a>
                    </li>
                    <!-- DISTRIBUCIÓN -->
                    <li class="nav-item has-treeview">
                        <a href="<?=RUTA?>distribucion" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Distribución</p>
                        </a>
                    </li>
                    <!-- IMPORTACIÓN -->
                    <li class="nav-item has-treeview">
                        <a href="<?=RUTA?>importacion" class="nav-link">
                        <i class="nav-icon fas fa-shipping-fast"></i>
                            <p>Importación</p>
                        </a>
                    </li>
                    <!-- CLIENTES -->
                    <li class="nav-item has-treeview d-none">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Clientes<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=RUTA?>clientes" class="nav-link">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Detalles de Clientes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>clientes/pagoClientes" class="nav-link">
                                    <i class="fas fa-comments-dollar nav-icon"></i>
                                    <p>Emisión de Cobros</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>clientes/anticipos" class="nav-link">
                                    <i class="fas fa-money-bill-wave nav-icon"></i>
                                    <p>Anticipos</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="<?=RUTA?>clientes/cxc" class="nav-link">
                                    <i class="fas fa-hand-holding-usd nav-icon"></i>
                                    <p>
                                        Cuentas x Cobrar
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>clientes/cxc" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i>
                                            <p>Alta de CxC</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>clientes/cxc" class="nav-link">
                                            <i class="fas fa-exchange-alt nav-icon"></i>
                                            <p>Movimientos de CxC</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=RUTA?>clientes/cxp" class="nav-link">
                                            <i class="fas fa-tags nav-icon"></i>
                                            <p>Conceptos de CxC</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?=RUTA?>reportes/clientes" class="nav-link">
                                    <i class="fas fa-chart-line nav-icon"></i>
                                    <p>Reportes</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="sidebar-custom d-none">
            <a href="<?=RUTA?>" class="btn btn-link text-white"><i class="fas fa-cogs mr-2"></i>Configuración</a>
        </div>
    <?php
    }
    ?>
</aside>
<!--===========================
MODAL CONTACTO
===========================--> 
<div class="modal fade p-0" id="modalContacto" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" class="formGeneral">                <!-- TITLE MODAL -->
                <!-- HEADER MODAL -->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-building mr-2"></i>Acerca de Tecsolt</h4>
                </div>
                <!-- BODY MODAL -->
                <div class="modal-body">
                    <div class="row">
                        <!-- QUIENES SOMOS -->
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="card mb-2 bg-gradient-dark rounded shadow">
                                <img class="card-img-top rounded" src="<?=RUTA?>public/img/about_us.png" alt="About Tecsolt" style="filter: brightness(80%); background-position: center center; background-size: cover; background-repeat: no-repeat;">
                                <div class="card-img-overlay d-flex flex-column justify-content-end rounded">
                                    <h1 class="text-white font-weight-bold">¿Quiénes somos?</h1>
                                    <p class="text-white">
                                        Somos una empresa  orgullosamente Mexicana que cuenta con 5 años 
                                        de experiencia en el desarrollo de soluciones tecnológicas a la medida, 
                                        actualmente la sede principal se encuentra en la ciudad de León, Guanajuato.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- MISION Y VISION -->
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="card mb-2 bg-gradient-dark rounded shadow">
                                <img class="card-img-top rounded" src="<?=RUTA?>public/img/mision_vision.png" alt="About Tecsolt" style="filter: brightness(50%); background-position: center center; background-size: cover; background-repeat: no-repeat;">
                                <div class="card-img-overlay d-flex flex-column justify-content-end rounded">
                                    <h1 class="text-white font-weight-bold">Misión y Visión</h1>
                                    <p class="text-white">
                                        Nuestra misión principalmente es mejorar e innovar los procesos de trabajo. 
                                        Así mismo la visión más importante que tenemos es ofrecer las mejores soluciones 
                                        tecnológicas que se enfoquen en cubrir cada una de las necesidades de nuestros clientes.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- SERVICIOS -->
                        <div class="col-12 my-3">
                            <hr>
                            <h1 class="font-weight-bold my-4 text-center">Nuetros Servicios</h1>
                            <style>
                                .icon-card{
                                    border-radius: 50%;
                                    width: 60px;
                                    height: 60px;
                                }
                                .text-black{
                                    color: black!important;
                                }
                                .cardPresentation {
                                    transition: all 0.3s ease-out;
                                }
                                .cardPresentation:hover {
                                    cursor: pointer;
                                    transform: translateY(-5px) scale(1.005) translateZ(0);
                                    box-shadow: box-shadow: 0px 6px 6px -3px rgba(0,0,0,0.2), 0px 10px 14px 1px rgba(0,0,0,0.14), 0px 4px 18px 3px rgba(0,0,0,0.12)
                                }
                            </style>
                            <div class="row align-items-center">
                                <!-- PAGINA WEB -->
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <a href="https://tecsolt.com/" target="_blank" class="cardPresentation card shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 mb-4 d-flex align-content-center justify-content-center">
                                                    <span class="d-flex align-items-center justify-content-center text-center bg-primary icon-card">
                                                    <i class="fas fa-tv fa-2x text-white"></i></span>
                                                </div>
                                                <div class="col-12 d-flex align-content-center justify-content-center mb-2">
                                                    <h3 class="text-black font-weight-bold">Páginas Web</h3>
                                                </div>
                                                <div class="col-12">
                                                    <p class="card-text text-muted">                  
                                                        Una página web te dara presencia en Internet, debe ser el centro de cualquier estrategia online. Sirve para dar a conocer tu marca, empresa o PyME, o los productos o servicios que tú ofreces, así mismo generarles confianza.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ECOMMERCE -->
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <a href="https://tecsolt.com/" target="_blank" class="cardPresentation card shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 mb-4 d-flex align-content-center justify-content-center">
                                                    <span class="d-flex align-items-center justify-content-center text-center bg-primary icon-card">
                                                    <i class="fas fa-shopping-cart fa-2x text-white"></i></span>
                                                </div>
                                                <div class="col-12 d-flex align-content-center justify-content-center mb-2">
                                                    <h3 class="text-black font-weight-bold">E-commerce</h3>
                                                </div>
                                                <div class="col-12">
                                                    <p class="card-text text-muted">
                                                        Vende tus productos en todo el mundo y en todo momento, tu tienda en línea las 24/7, incrementa tus ingresos de la forma más sencilla. Ofrece una amplia gama de productos o servicios, estén donde estén. 
                                                        <!-- Amplia tus horizontes, vende tus productos en todo el mundo y en todo momento, tu tienda en línea 24 horas al día los 7 días de la semana, incrementa tus ingresos, ventas y clientes de la forma más sencilla. Ofrece una amplia gama productos o servicios con las facilidades de pago existen en el mercado, esten donde esten.  -->
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- APPS MOVILES -->
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <a href="https://tecsolt.com/" target="_blank" class="cardPresentation card shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 mb-4 d-flex align-content-center justify-content-center">
                                                    <span class="d-flex align-items-center justify-content-center text-center bg-primary icon-card">
                                                    <i class="fas fa-mobile-alt fa-2x text-white"></i></span>
                                                </div>
                                                <div class="col-12 d-flex align-content-center justify-content-center mb-2">
                                                    <h3 class="text-black font-weight-bold">Apps Móviles</h3>
                                                </div>
                                                <div class="col-12">
                                                    <p class="card-text text-muted">
                                                        Crear una app para tu empresa trae múltiples beneficios, crear vínculos más íntimos con tu audiencia o clientes, captación, ser empresa innovadora y actualizada entre otros beneficios.
                                                        <!-- Crear una app para tu empresa trae múltiples beneficios, permite tener un canal de fidelización como pocos, crear vínculos más íntimos con tu audiencia o clientes, captación entre otros beneficios, ademas te distingue de la competencia al ser una empresa innovadora y actualizada. -->
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- REDES SOCIALES -->
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <a href="https://tecsolt.com/" target="_blank" class="cardPresentation card shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 mb-4 d-flex align-content-center justify-content-center">
                                                    <span class="d-flex align-items-center justify-content-center text-center bg-primary icon-card">
                                                    <i class="fas fa-bullhorn fa-2x text-white"></i></span>
                                                </div>
                                                <div class="col-12 d-flex align-content-center justify-content-center mb-2">
                                                    <h3 class="text-black font-weight-bold">Community Manager</h3>
                                                </div>
                                                <div class="col-12">
                                                    <p class="card-text text-muted">
                                                        <!-- Te ofrecemos de forma personalizada la estrategia de negocios y marketing digital para ayudarte a enfocar tu negocio en el rumbo adecuado, creando la(s) campaña(s) que mejor se ajusten a tu negocio generando adquisición constante de clientes potenciales y ventas. Creamos una comunidad al rededor de tu producto o servicio mediante estrategias multicanal a través de redes sociales, llevando el espíritu de tu marca a nuevos clientes potenciales, aumentando tus ventas e imagen de marca. -->
                                                        Creamos una comunidad al rededor de tu producto o servicio mediante estrategias multicanal a través de redes sociales, llevando el espíritu de tu marca a nuevos clientes potenciales, aumentando tus ventas e imagen de marca.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- DISEÑO GRAFICO-->
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <a href="https://tecsolt.com/" target="_blank" class="cardPresentation card shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 mb-4 d-flex align-content-center justify-content-center">
                                                    <span class="d-flex align-items-center justify-content-center text-center bg-primary icon-card">
                                                    <i class="fas fa-swatchbook fa-2x text-white"></i></span>
                                                </div>
                                                <div class="col-12 d-flex align-content-center justify-content-center mb-2">
                                                    <h3 class="text-black font-weight-bold">Diseño Gráfico</h3>
                                                </div>
                                                <div class="col-12">
                                                    <p class="card-text text-muted">
                                                        Desarrollamos el diseño correcto, original y exclusivo para representar los valores, la identidad y el propósito de tu negocio.  Comienza a dialogar con tu audiencia antes de que lean la primera palabra a través de una identidad que te distinga del resto.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- PRODUCCIÓN Y EDICIÓN DE VIDEOS -->
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <a href="https://tecsolt.com/" target="_blank" class="cardPresentation card shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 mb-4 d-flex align-content-center justify-content-center">
                                                    <span class="d-flex align-items-center justify-content-center text-center bg-primary icon-card">
                                                    <i class="fas fa-photo-video fa-2x text-white"></i></span>
                                                </div>
                                                <div class="col-12 d-flex align-content-center justify-content-center mb-2">
                                                    <h3 class="text-black font-weight-bold">Fotos & Videos</h3>
                                                </div>
                                                <div class="col-12">
                                                    <p class="card-text text-muted">
                                                        Creamos contenido audiovisual creativo digital. Transformamos en imagen y sonido tu ideas, logrando el objetivo deseado, donde tus consumidores conecten con tu marca, manteniéndolos activos e interesados en tu mensaje mediante el uso de las redes sociales.
                                                        <!-- Creamos contenido audiovisual creativo digital, basado en una estrategia para su transmisión efectiva de tu mensaje. Transformamos en imagen y sonido tu ideas, logrando el objetivo deseado, donde tus consumidores conecten con tu marca, manteniéndolos activos e interesados en tu mensaje mediante el uso de las redes sociales. -->
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- REDES SOCIALES -->
                        <div class="col-12 d-flex align-content-center justify-content-center">
                            <a href="https://www.facebook.com/tecsolt/" class="btn btn-light mx-2" target="_black"><i class="fab fa-facebook-f fa-2x"></i></a>
                            <a href="https://www.twitter.com/tecsoltcompany/" class="btn btn-light mx-2" target="_black"><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="https://www.instagram.com/tecsolt/" class="btn btn-light mx-2" target="_black"><i class="fab fa-instagram fa-2x"></i></a>
                        </div>

                    </div>
                </div>
                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn <?= BTN_MODAL_CANCEL ?>" data-dismiss="modal"><i class="<?=ICON_BACK?> mr-2"></i>Regresar</button>
                </div>
            </form>
        </div>
    </div>
</div>