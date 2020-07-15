/*=============================================
=            SUBIENDO FOTO DEL USUARIO        =
=============================================*/

$('.nuevaFoto').change(function() {
	var imagen = this.files[0];
	
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
		$('.nuevaFoto').val('');
		swal.fire({
			text:"Error al subir imagen. La imagen debe estar en formato JPG o PNG.",
			icon:"error",
			confirmButtonText:"Cerrar"
		});
	} else if(imagen["size"] > 20000000) {
		$('.nuevaFoto').val(''); 
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

//GUARDAR USUARIO
$('.formRegistrarUsuario').on('submit', function(e) {
	e.preventDefault();
	$.ajax({
		url: "ajax/guardarUsuario.ajax.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success: function(respuesta){

			respuesta = respuesta.split(',');

			if(respuesta[0] == 'ok') {
				swal.fire({
					icon: "success",
					text: "¡El usuario ha sido registrado correctamente. Porfavor inice sesión!",
					confirmButtonText: "Cerrar"
				}).then(function(){
					$('#modalNuevoUsuario').modal('hide');
				});
			} 
			
			if(respuesta[0] == 'Existe'){
		        swal.fire({
		          icon: "error",
		          text: "¡El" + respuesta[1] + " ya existe en la base de datos!",
		          confirmButtonText: "Cerrar"
		        })
			 } 
			 
			if(respuesta[0] == 'error') {
				swal.fire({
					icon: "error",
					text: "¡Complete los campos requeridos. Recuerde no usar caracteres especiales!",
					confirmButtonText: "Cerrar"
				})
			}
		}	 
	});
})

$('#modalNuevoUsuario').on('hidden.bs.modal', function(e)
{ 
    $('#nombre').val('');
    $('#email').val('');
    $('#usuario').val('');
    $('#password').val('');
    $('#perfil').val('');
    $('#nuevaFoto').val("");;
    $('.previsualizar').attr("src","vistas/img/usuarios/default/anonymous.png");
}) ;



//MOSTRAR NOTICIAS
var tablaPaginaNoticias = $('.tablaPaginaNoticias').DataTable({
    "ajax": "ajax/datatable-pagina-noticias.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "bInfo": false,
    "bLengthChange": false,
    "order": [[ 1, "desc" ]],
    "pageLength": 5,
    "columnDefs": [
        {
            "targets": [ 1 ],
            "visible": false,
            "searchable": true
        }
    ],
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

$(document).on('click', '.btnOrdenar', function() {
    if($(this).hasClass('desc')) {
        $('.tablaPaginaNoticias').dataTable().fnSort([ [1,'asc']] );
        $(this).removeClass('desc');
        $(this).addClass('asc');
    } else {
        $('.tablaPaginaNoticias').dataTable().fnSort([ [1,'desc']] );
        $(this).removeClass('asc');
        $(this).addClass('desc');
    }
})


$(document).on('click', '.noticia',function() {
    var idNoticia = $(this).attr('idNoticia');
    
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

            //Fecha
            var date = new Date(respuesta['created_at']);

            var dia = date.getDate();
            if(dia < 10) {
                dia = "0"+dia;
            }

            var mes = date.getMonth() + 1;
            if(mes < 10) {
                mes = "0"+mes;
            }

            var año = date.getFullYear();
            
            var fecha = dia + "/" + mes + "/" + año; 

            //Usuario
            var datos = new FormData();
            datos.append("idUsuario",respuesta['id_usuario']);

            usuario = '';

            $.ajax({
                url:"ajax/usuarios.ajax.php",
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData:false,
                dataType:"json",
                async:false,
                success: function(respuesta) {
                    usuario = respuesta['nombre']
                }
            });
            
			$('#tituloVerNoticia').html('<h3>'+respuesta['titulo']+'</h3>');
            
            $('.imgNoticia').html('<img src="'+respuesta['imagen']+'" width="50%">')

            $('.descNoticia').html('<strong>Publicado por </strong>'+usuario+'<br>'+
                fecha+'<br><br>'+respuesta['descripcion']+
                '<br><br><div class="divPalabras"></div>');
            
            var palabrasClave = JSON.parse(respuesta['palabras_clave']);

            for(var i=0; i<palabrasClave.length; i++) {
                $('.divPalabras').append(
                    '<span class="mr-5"><strong>'+palabrasClave[i]+'</strong></span>'
                );
            }

		}
	});

})