<?php

require_once "../controladores/noticias.controlador.php";
require_once "../modelos/noticias.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaNoticias{

 	/*=============================================
 	 MOSTRAR LA TABLA DE NOTICIAS
  	=============================================*/ 

	public function mostrarTablaNoticias(){

		
		$item = null;
        $valor = null;
        $noticias = ControladorNoticias::ctrMostrarNoticias($item, $valor);

		
		if(count($noticias) > 0) {

			$datosJson = '{
			"data": [';

			for($i = 0; $i < count($noticias); $i++){

				if($noticias[$i]["imagen"] != '') {
					$imagen =  "<img src='".$noticias[$i]['imagen']."' class='img-thumbnail' width='40px'>";
				} else {
					$imagen = '';
				}
				

				$descripcion = strip_tags($noticias[$i]["descripcion"]);			
				$descripcion = substr($descripcion, 0, 80) . '...';

				
				$palabrasClave = '';

				if($noticias[$i]["palabras_clave"] != '') {

					$palabras = json_decode($noticias[$i]["palabras_clave"], true);

					foreach($palabras as $palabra) {
						$palabrasClave .= $palabra . ' - ';
					}

					$palabrasClave = substr($palabrasClave, 0 ,-2);
				}

				$item = 'id';
				$valor = $noticias[$i]['id_usuario'];
				$usuario = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);


				$fecha = new DateTime($noticias[$i]["created_at"]);
				$fecha = $fecha->format('d/m/Y'); 

                $noticia = '<div class=\'col-md-12\'>'.
                    '<div class=\'card flex-md-row mb-4 box-shadow h-md-250\'>'.
                    '<div class=\'card-body d-flex flex-column align-items-start\'>'.
                        '<h3 class=\'mb-0\'>'.
                        '<a class=\'text-dark noticia\' data-toggle=\'modal\' data-target=\'#modalNoticia\' href=\'#\' idNoticia=\''.$noticias[$i]['id'].'\'>'.$noticias[$i]['titulo'].'</a>'.
                        '</h3>'.
                        '<div class=\'mb-1 text-muted\'>'.$fecha.'</div>'.
                        '<p class=\'card-text mb-auto\'>'.$descripcion.'</p>'.
                        '<a class=\'noticia\' data-toggle=\'modal\' data-target=\'#modalNoticia\' href=\'#\' idNoticia=\''.$noticias[$i]['id'].'\'>Continue reading</a>'.
                    '</div>'.
                    '<img class=\'card-img-right flex-auto d-none d-md-block\' src=\''.$noticias[$i]['imagen'].'\' width=\'200px\' height=\'200px\'>'.
                    '</div>'.
                '</div>';


				$datosJson .='[
				"'.$noticia.'",
				"'.$fecha.'"
				],';

			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson .=   '] 

			}';
			
			echo $datosJson;
		
		} else {

			$datosJson = '{"data":[["",""]]}';

			echo $datosJson;
		}


	}

}


$noticias = new TablaNoticias();
$noticias -> mostrarTablaNoticias();

