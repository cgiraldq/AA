<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
// operaciones genericas de relaciones de muchos a muchos
*/
		$x=$_REQUEST['sel1'];
		$contar=count($x);

		$idposagrupamiento=$_REQUEST['pos'];


		if ($_REQUEST['paso']==1){

		$sql="delete from $tablarelaciones1 where idorigen=$idx";

		$db->Execute($sql);
			for ($i=0;$i<$contar;$i++){
				// borrar las asignaciones de prod e ingresar de nuevo

					$sql="insert into $tablarelaciones1 (idorigen,iddestino) values($idx,".$x[$i].")";

			//echo $sql."<br>";
				if ($db->Execute($sql)) $h;
			}
//		if ($h>0) $mensajes.=" y se actualizan sus asociaciones";
		}
?>
