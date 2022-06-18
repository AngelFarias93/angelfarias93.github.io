<?php
  $ControladorCore = new ControladorCore();
  $ControladorCore->cargarControlador("users");
  $objUsers = new UsersController();
  $infoUsuario = $objUsers->traerInformacionAjaxDinamic("usuarios", null, null, "id=".$_SESSION["id"], null, 1);
?>
<script>
  Dropzone.autoDiscover = false;
  $(document).ready(function(){
    $("body").addClass("lockscreen");
  });
</script>
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo mb-5">
    <h3 class="font-weight-bold mb-1 text-muted">VMC</h3>
    <h6 class="text-muted my-1">PROJECT MANAGEMENT</h6>
  </div>
  <!-- NOMBRE DEL USUARIO -->
  <div class="lockscreen-name"><?=$infoUsuario["nombre"]?> <?=$infoUsuario["apellido"]?></div>

  <div class="lockscreen-item mb-4">
    <div class="lockscreen-image">
      <img src="<?=LOGOTECSOLT?>" alt="Tecsolt" class="brand-image img-circle" style="opacity: .8">
    </div>
    <form class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="********">
        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fas fa-unlock-alt text-muted"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="help-block text-center text-muted mb-5">
    Ingresa tu contraseña para volver a entrar al sistemas por favor.
    <div class="text-center">
        <a href="#" class="closeSessionUser"> O inicia sesión con un usuario diferente.</a>
    </div>
  </div>
  <div class="lockscreen-footer text-center">
    <p class="mb-1"><b>Copyright &copy; <?=date('Y')?> by <a href="https://tecsolt.com" target="_blank" rel="noopener">Tecsolt.com</a>.</b></p>
    <p class="mb-0">Todo los derechos reservados</p>
    <small class="text-muted">
      <b>Version</b> <?=VERSION?>
    </small>
  </div>
</div>