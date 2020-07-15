<?php

  $tabla = "usuarios";
  $item = "id";
  $valor = $_SESSION['id'];
  $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/noticias" class="nav-link">Ver noticias</a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <?php 
              if($respuesta['foto'] == '') {
                $foto = 'vistas/img/usuarios/default/anonymous.png';
              } else {
                $foto = $respuesta['foto'];
              }
            ?>
            <img src="<?php echo $foto ?>" class="img-circle mr-2" width="35" height="35">
            <?php echo $respuesta['nombre'] ?>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <a href="#" class="dropdown-item dropdown-footer btnEditarPerfilUsuario" 
            data-toggle='modal' data-target='#modalEditarPerfilUsuario'
            idUsuario=<?php echo $respuesta['id'] ?>>Editar perfil</a>
        </div>
      </li>
    </ul>
  </nav>


  <!-- Modal editar usuario-->
<div class="modal fade" id="modalEditarPerfilUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Editar perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <form role="form" method="post" class="formEditarPerfilUsuario" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="editarPerfilNombre">Nombre</label>
                    <input type="text" name="editarPerfilNombre" class="form-control" id="editarPerfilNombre">
                    <input type="hidden" id="idUsuarioPerfil" name="idUsuarioPerfil">
                  </div>
                  <div class="form-group">
                    <label for="editarPerfilEmail">Email</label>
                    <input type="email" name="editarPerfilEmail" class="form-control" id="editarPerfilEmail">
                    <input type="hidden" id="emailActualPerfil" name="emailActualPerfil">
                  </div>
                  <div class="form-group">
                    <label for="editarPerfilUsuario">Usuario</label>
                    <input type="text" name="editarPerfilUsuario" class="form-control" id="editarPerfilUsuario">
                    <input type="hidden" id="usuarioActualPerfil" name="usuarioActualPerfil">
                  </div>
                  <div class="form-group">
                    <label for="editarPerfilPassword">Password</label>
                    <input type="password" name="editarPerfilPassword" class="form-control" id="editarPerfilPassword">
                    <input type="hidden" id="passwordActualPerfil" name="passwordActualPerfil">
                  </div>
                  <div class="form-group">
                    <label for="nuevaFoto">Foto</label><br>
                    <input type="file" class="nuevaFoto" name="editarFotoPerfil">
                    <p class="help-block">Peso máximo de la foto: 20 MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                    <input type="hidden" id="fotoActualPerfil" name="fotoActualPerfil">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>