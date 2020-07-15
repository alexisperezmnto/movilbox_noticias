<div class="content-wrapper">
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Noticias</h1>
            <button type='button' class="btn btn-primary btn-sm mt-2" 
              data-toggle="modal" data-target="#modalNuevaNoticia">
              <span class="glyphicon glyphicon-plus" ></span> Nueva noticia</button>
          </div>
        </div>
      </div>
    </section>

    <section class="content">

      <table class="table table-bordered table-striped dt-responsive tablaNoticias">
          <thead>
            <tr>
              <th>Imagen</th>
              <th>Título</th>
              <th style="width:20%">Descripción</th>
              <th>Palabras clave</th>
              <th>Usuario</th>
              <th>Fecha</th>
              <th>Acción</th>
            </tr>
          </thead>
      </table>	

    </section>
    
</div>


<!-- Modal nueva noticia-->
<div class="modal fade" id="modalNuevaNoticia" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Nuevo noticia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <form role="form" method="post" class="formNoticia" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" class="form-control" id="titulo">
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="10"></textarea>
                  </div>

                  <label for="palabrasClave">Palabras clave</label><br>
                  <div class="input-group mb-3">
                    <input type="text" name="palabrasClave" class="form-control" id="palabrasClave">
                    <div class="input-group-append">
                      <button class="btn btn-primary agregarPalabra" type="button"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  
                  <div class="divPalabrasClave mt-2"></div>
                  <input type="hidden" name="palabrasClaveHidden" id="palabrasClaveHidden">
                  
                  <div class="form-group mt-5">
                    <label for="imagenNoticia">Imagen</label><br>
                    <input type="file" class="imagenNoticia" name="imagenNoticia" id="imagenNoticia">
                    <p class="help-block">Peso máximo de la foto: 20 MB</p>
                    <img src="" class="img-thumbnail previsualizar" width="30%">
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

<!-- Modal editar  noticia-->
<div class="modal fade" id="modalEditarNoticia" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Editar noticia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <form role="form" method="post" class="formEditarNoticia" enctype="multipart/form-data">
                <input type="hidden" id="idNoticia" name="idNoticia">
                <div class="card-body">
                  <div class="form-group">
                    <label for="editarTitulo">Título</label>
                    <input type="text" name="editarTitulo" class="form-control" id="editarTitulo">
                  </div>
                  <div class="form-group">
                    <label for="editarDescripcion">Descripción</label>
                    <textarea name="editarDescripcion" id="editarDescripcion" class="form-control" rows="10"></textarea>
                  </div>
                  
                  <label for="editarPalabrasClave">Palabras clave</label><br>
                  <div class="input-group mb-3">
                    <input type="text" name="editarPalabrasClave" class="form-control" id="editarPalabrasClave">
                    <div class="input-group-append">
                      <button class="btn btn-primary agregarPalabraEditar" type="button"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                  
                  <div class="divEditarPalabrasClave mt-2"></div>
                  <input type="hidden" name="palabrasClaveEditarHidden" id="palabrasClaveEditarHidden">

                  <div class="form-group mt-5">
                    <label for="imagenNoticia">Imagen</label><br>
                    <input type="file" class="imagenNoticia" name="editarImagenNoticia" id="imagenNoticia">
                    <p class="help-block">Peso máximo de la foto: 20 MB</p>
                    <img src="" class="img-thumbnail previsualizar" width="30%">
                    <input type="hidden" id="imagenActual" name="imagenActual">
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