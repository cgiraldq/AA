<?
/*
| ----------------------------------------------------------------- |
RECUPERACION DE ARCHIVO INDEPENDIENTE DEL METODO Y APLICACION DE FUNCIONES
*/
if (count($_GET)>0) {

		foreach($_GET as $nombre_campo => $valor){
		   $asignacion = "\$" . $nombre_campo . "='" . Security(limpiar_carateres($valor)). "';";
		   eval($asignacion);
		}

}

if (count($_POST)>0) {

		foreach($_POST as $nombre_campo => $valor){
		   $asignacion = "\$" . $nombre_campo . "='" . Security(limpiar_carateres($valor)). "';";
		   eval($asignacion);
		}

}


if (count($_REQUEST)>0) {

		foreach($_REQUEST as $nombre_campo => $valor){
		   $asignacion = "\$" . $nombre_campo . "='" . Security(limpiar_carateres($valor)). "';";
		   eval($asignacion);
		}

}

if (count($_SESSION)>0) {

		foreach($_SESSION as $nombre_campo => $valor){
		   $asignacion = "\$" . $nombre_campo . "='" . Security(limpiar_carateres($valor)). "';";
		   eval($asignacion);
		}

}


?>