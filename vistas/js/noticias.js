$(document).ready(function() {
    $('#descripcion').summernote();
    $('#editarDescripcion').summernote();
  });

var tablaNoticias = $('.tablaNoticias').DataTable({
      "ajax": "ajax/datatable-noticias.ajax.php",
      "deferRender": true,
      "retrieve": true,
      "processing": true,
	  "bInfo": false,
	  "bLengthChange": false,
      "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "NingÃºn dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Ãšltimo",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    }); 


/*=============================================
=            SUBIENDO FOTO NOTICIA       =
=============================================*/

$('.imagenNoticia').change(function() {
	var imagen = this.files[0];
	
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
		$('.imagenNoticia').val('');
		swal.fire({
			text:"Error al subir imagen. La imagen debe estar en formato JPG o PNG.",
			icon:"error",
			confirmButtonText:"Cerrar"
		});
	} else if(imagen["size"] > 20000000) {
		$('.imagenNoticia').val(''); 
		swal({
			text:"Error al subir imagen. La imagen no debe pesar más de 2 MB.",
			icon:"error",
			confirmButtonText:"Cerrar"
		});	
	} else {
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on('load', function(event){
			var rutaImagen = event.target.result;

			$('.previsualizar').attr('src',rutaImagen);
		})
	}
})


//PALABRAS CLAVE

var palabrasClave = [];

$(document).on('change', '#palabrasClave', function() {
    funcionPalabrasClave()
})

$(document).on('keypress', '#palabrasClave', function(e) {
    if(e.keyCode == 13) {
        e.preventDefault();
        funcionPalabrasClave()
    }
})

$(document).on('click', '.agregarPalabra', function() {
    funcionPalabrasClave()
})

function funcionPalabrasClave() {
    var palabra = $('#palabrasClave').val();
    if(palabra.trim() == '') return
    
    for(var i=0; i<palabrasClave.length; i++) {
        if(palabra == palabrasClave[i]) {
            return
        }
    }
    
    palabrasClave.push(palabra);

    $('.divPalabrasClave').html('');

    for(var i=0; i<palabrasClave.length; i++) {
        $('.divPalabrasClave').append(
            '<span class="mr-5"><strong>'+palabrasClave[i]+'</strong>'+
            '<i class="fa fa-times ml-3 quitarPalabra" style="color:red; cursor:pointer"'+ 
            'palabra="'+palabrasClave[i]+'"></i></span>'
        );
    }

    $('#palabrasClave').val('');    

    $('#palabrasClaveHidden').val(JSON.stringify(palabrasClave));
}

$(document).on('click', '.quitarPalabra', function() {
    var palabra = $(this).attr('palabra'); 
    for(var i=0; i<palabrasClave.length; i++) {
        if(palabra == palabrasClave[i]) {
            palabrasClave.splice(i, 1);
        }
    }

    $('.divPalabrasClave').html('');

    for(var i=0; i<palabrasClave.length; i++) {
        $('.divPalabrasClave').append(
            '<span class="mr-5"><strong>'+palabrasClave[i]+'</strong>'+
            '<i class="fa fa-times ml-3 quitarPalabra" style="color:red; cursor:pointer"'+ 
            'palabra="'+palabrasClave[i]+'"></i></span>'
        );
    }

    if(palabrasClave.length) {
        $('#palabrasClaveHidden').val(JSON.stringify(palabrasClave));
    } else {
        $('#palabrasClaveHidden').val('');
    }

})

//GUARDAR NOTICIA
$('.formNoticia').on('submit', function(e) {
	e.preventDefault();
	$.ajax({
		url: "ajax/guardarNoticia.ajax.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success: function(respuesta){

			if(respuesta == 'ok') {
				tablaNoticias.ajax.reload(null, false);
				swal.fire({
					icon: "success",
					text: "¡La noticia ha sido registrada correctamente!",
					confirmButtonText: "Cerrar"
				}).then(function(){
					$('#modalNuevaNoticia').modal('hide');
				});
			} 
			
			if(respuesta == 'error') {
				swal.fire({
					icon: "error",
					text: "¡Complete los campos requeridos. Recuerde no usar caracteres especiales!",
					confirmButtonText: "Cerrar"
				})
			}
		}	 
	});
})

/*=============================================
=            EDITAR NOTICIA        =
=============================================*/

var palabrasClaveEditar = [];

$(document).on('click','.btnEditarNoticia', function(){
	var idNoticia = $(this).attr("idNoticia");
	
	var datos = new FormData();
	datos.append("idNoticia",idNoticia);

	$.ajax({
		url:"ajax/noticias.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
        dataType:"json",
        
		success: function(respuesta) {
			$('#idNoticia').val(respuesta['id']);
			$('#editarTitulo').val(respuesta['titulo']);
            $('#editarDescripcion').summernote('code', respuesta['descripcion']);

            $('#editarPalabrasClave').val('');
            $('#palabrasClaveEditarHidden').val(respuesta['palabras_clave']);
            
            palabrasClaveEditar = JSON.parse(respuesta['palabras_clave']);

            for(var i=0; i<palabrasClaveEditar.length; i++) {
                $('.divEditarPalabrasClave').append(
                    '<span class="mr-5"><strong>'+palabrasClaveEditar[i]+'</strong>'+
                    '<i class="fa fa-times ml-3 quitarPalabraEditar" style="color:red; cursor:pointer"'+ 
                    'palabra="'+palabrasClaveEditar[i]+'"></i></span>'
                );
            }

			$('#imagenActual').val(respuesta['imagen']);

			if(respuesta['imagen'] != "") {
				$('.previsualizar').attr("src",respuesta['imagen']);
			} else {
				$('.previsualizar').attr("");
			}
		}
	});
})

//EDITAR NOTICIA
$('.formEditarNoticia').on('submit', function(e) {
	e.preventDefault();
	$.ajax({
		url: "ajax/guardarNoticia.ajax.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success: function(respuesta){

			if(respuesta == 'ok') {
				tablaNoticias.ajax.reload(null, false);
				swal.fire({
					icon: "success",
					text: "¡La noticia ha sido editada correctamente!",
					confirmButtonText: "Cerrar"
				}).then(function(){
					$('#modalEditarNoticia').modal('hide');
				});
			} 
			
			 if(respuesta == 'error'){
				swal.fire({
					icon: "error",
					text: "¡Complete los campos requeridos. Recuerde no usar caracteres especiales!",
					confirmButtonText: "Cerrar"
				})
			}
		}	 
	});
})


//PALABRAS CLAVE EDITAR

$(document).on('change', '#editarPalabrasClave', function() {
    funcionPalabrasClaveEditar()
})

$(document).on('keypress', '#editarPalabrasClave', function(e) {
    if(e.keyCode == 13) {
        e.preventDefault();
        funcionPalabrasClaveEditar()
    }
})

$(document).on('click', '.agregarPalabraEditar', function() {
    funcionPalabrasClaveEditar()
})

function funcionPalabrasClaveEditar() {
    var palabra = $('#editarPalabrasClave').val();
    if(palabra.trim() == '') return
    
    for(var i=0; i<palabrasClaveEditar.length; i++) {
        if(palabra == palabrasClaveEditar[i]) {
            return
        }
    }
    
    palabrasClaveEditar.push(palabra);

    $('.divEditarPalabrasClave').html('');

    for(var i=0; i<palabrasClaveEditar.length; i++) {
        $('.divEditarPalabrasClave').append(
            '<span class="mr-5"><strong>'+palabrasClaveEditar[i]+'</strong>'+
            '<i class="fa fa-times ml-3 quitarPalabraEditar" style="color:red; cursor:pointer"'+ 
            'palabra="'+palabrasClaveEditar[i]+'"></i></span>'
        );
    }

    $('#editarPalabrasClave').val('');    

    $('#palabrasClaveEditarHidden').val(JSON.stringify(palabrasClaveEditar));
}

$(document).on('click', '.quitarPalabraEditar', function() {
    var palabra = $(this).attr('palabra'); 
    for(var i=0; i<palabrasClaveEditar.length; i++) {
        if(palabra == palabrasClaveEditar[i]) {
            palabrasClaveEditar.splice(i, 1);
        }
    }

    $('.divEditarPalabrasClave').html('');

    for(var i=0; i<palabrasClaveEditar.length; i++) {
        $('.divEditarPalabrasClave').append(
            '<span class="mr-5"><strong>'+palabrasClaveEditar[i]+'</strong>'+
            '<i class="fa fa-times ml-3 quitarPalabraEditar" style="color:red; cursor:pointer"'+ 
            'palabra="'+palabrasClaveEditar[i]+'"></i></span>'
        );
    }

    if(palabrasClaveEditar.length) {
        $('#palabrasClaveEditarHidden').val(JSON.stringify(palabrasClaveEditar));
    } else {
        $('#palabrasClaveEditarHidden').val('');
    }

})


/*=============================================
=       ELIMINAR NOTICIA       			      =
=============================================*/

$(document).on('click','.btnEliminarNoticia', function(){
	var idNoticia = $(this).attr('idNoticia');
	var imagenNoticia = $(this).attr('imagenNoticia');

	var datos = new FormData();
	datos.append('eliminarNoticia', idNoticia);
	datos.append('imagenNoticia', imagenNoticia);

	swal.fire({
		text: '¿Está seguro de eliminar la noticia?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Eliminar',
		cancelButtonText: 'Cancelar'
	}).then((result)=>{
		if(result.value) {
			$.ajax({
				url:"ajax/noticias.ajax.php",
				method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success: function(respuesta) {
					if(respuesta == 'ok') {
						tablaNoticias.ajax.reload();
						swal.fire({
							icon: "success",
							text: "¡La noticia ha sido eliminada correctamente!",
							confirmButtonText: "Cerrar"
						})
					} else {
						tablaNoticias.ajax.reload();
						swal.fire({
							icon: "error",
							text: "Se produjo un error al eliminar el usuario.",
							confirmButtonText: "Cerrar"
						})
					}
				}
			});
		}
	})
})


$('#modalNuevaNoticia').on('hidden.bs.modal', function(e)
    { 
        $('#titulo').val('');
        $('#descripcion').summernote('code', '');
        $('#palabrasClave').val('');
        $('#imagenNoticia').val("");;
        $('.previsualizar').attr("src","");

        $('#palabrasClave').val('');  
        $('.divPalabrasClave').html('');
        $('#palabrasClaveHidden').val('')
        palabrasClave = [];
    }) ;


$('#modalEditarNoticia').on('hidden.bs.modal', function(e)
    { 
        $('.previsualizar').attr("src","");

        $('#editarPalabrasClave').val('');  
        $('.divEditarPalabrasClave').html('');
        $('#palabrasClaveEditarHidden').val('')
        palabrasClaveEditar = [];
    }) ;


