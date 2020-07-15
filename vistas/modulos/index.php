<header>
    <div class="navbar navbar-dark bg-dark box-shadow navbar-expand-lg">
        <div class="container d-flex justify-content-between">
            <div>
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>Noticias.com</strong>
                </a>
            </div>

            <?php if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') : ?>
                
                <?php 

                    $tabla = "usuarios";
                    $item = "id";
                    $valor = $_SESSION['id'];
                    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

                ?>

                <div class="divLoguedIn">
                    <ul class="navbar-nav ml-auto">
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
                            <a href="/noticias/inicio" class="dropdown-item dropdown-footer">Administrar</a>
                            <a href="/noticias/salir" class="dropdown-item dropdown-footer">Salir</a>
                          </div>
                        </li>
                    </ul>
                </div>

            <?php else: ?>
                
                <div class="divInicioRegistro" style="cursor:pointer">
                    <span data-toggle="modal" class="mr-2" data-target="#modalInicioSesion">Iniciar sesión</span> 
                    | 
                    <span data-toggle="modal" class="ml-2" data-target="#modalNuevoUsuario">Registrarse</span>
                </div>

            <?php endif; ?>
            
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Noticias.com</h1>
        <p class="lead text-muted">Pellentesque scelerisque pulvinar diam at scelerisque. Suspendisse quis nibh ut sem maximus eleifend. Donec imperdiet fringilla auctor. Pellentesque tincidunt risus eget nisl iaculis hendrerit. Praesent auctor neque at dui ultricies efficitur. </p>
        <p>
        <a href="#" class="btn btn-primary my-2">Duis sit amet</a>
        <a href="#" class="btn btn-secondary my-2">Suspendisse sit amet</a>
        </p>
    </div>
    </section>

    <div class="container">
      <div class="row">
        <div class="col-md-8">

        <button class="btn-secondary btn-sm btnOrdenar desc">Ordenar</button>
          <table class="table table-bordered table-striped dt-responsive tablaPaginaNoticias" style="width:100%">
              <thead>
                <tr>
                  <th>Columna 1</th>
                  <th>Fecha</th>
                </tr>
              </thead>
          </table>	
        </div>

        <aside class="col-md-4 blog-sidebar">
          <div class="p-3 mb-3 bg-light rounded">
            <h4 class="font-italic">About</h4>
            <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>

          <div class="p-3 mb-3 bg-light rounded">
            <h4 class="font-italic">Duis sit amet cursus</h4>
            <p class="mb-0">Praesent porttitor tortor ut diam ullamcorper tristique. Duis sit amet cursus est, sit amet volutpat tortor. Nam euismod, elit quis tempor tincidunt, sapien mi pretium risus, sed dictum elit velit eu dolor. Sed blandit orci ac mauris sagittis, ut mattis nibh euismod. Maecenas bibendum dictum mauris eget elementum. In eu pretium nisl, id varius leo. Nunc tempor mattis magna in venenatis. Vestibulum sit amet nisl vitae ligula efficitur ultrices vulputate eget mauris. Aenean luctus ligula elit, sed vehicula arcu tempus sed. Maecenas eget lectus pretium, posuere justo vel, fringilla lacus. Integer odio neque, ultricies non euismod pellentesque, accumsan sed ante. Integer at gravida justo. Suspendisse faucibus enim massa, at interdum urna pulvinar in. </p>
          </div>
        </aside>
      </div>
    </div>

</main>

<footer class="main-footer mt-5">
    <div class="text-center">
        <strong>Copyright &copy; 2020 <a href="/noticias">Noticias.com</a>.</strong> Todos los derechos
            reservados.
        
    </div>
</footer>

<!-- Modal inicio sesión-->
<div class="modal fade" id="modalInicioSesion" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Inicio sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <form role="form" method="post" class="inicioSesionForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" class="form-control" id="usuario">
                  </div>
                  <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal nuevo usuario-->
<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Nuevo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <form role="form" method="post" class="formRegistrarUsuario" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                  </div>
                  <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" class="form-control" id="usuario" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                  </div>
                  <input type="hidden" name="perfil" id="perfil" value="Usuario">
                  <div class="form-group">
                    <label for="nuevaFoto">Foto</label><br>
                    <input type="file" class="nuevaFoto" name="nuevaFoto" id="nuevaFoto">
                    <p class="help-block">Peso máximo de la foto: 20 MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
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

<!-- Modal noticia-->
<div class="modal fade" id="modalNoticia" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloVerNoticia"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-body">
              <div class="imgNoticia text-center"></div>
              <div class="descNoticia mt-5"></div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

