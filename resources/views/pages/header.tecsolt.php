<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!--<li class="nav-item">
      <a class="nav-link" href="#" role="button">
        <i class="fas fa-user-circle"></i>
      </a>
    </li>-->
    <?php
    //if ($_SESSION["perfil"] != "Cliente"){
      ?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#scanQrPallet" href="#" role="button">
          <i class="far fa-qrcode"></i>
        </a>
      </li>
      <?php
      //}
    ?>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link lockSession" href="#" role="button">
        <i class="fas fa-lock-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link logoutSystem" href="<?= RUTA ?>logout/<?= $_SESSION["id"] ?>" role="button">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li>
  </ul>
</nav>