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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
// operaciones genericas de relaciones de muchos a muchos
*/
		$x=$_REQUEST['sel'];
		$contar=count($x);
		if ($_REQUEST['paso']==1){
		$sql="delete from $tablarelaciones where idorigen=$idx";
		$db->Execute($sql);
			for ($i=0;$i<$contar;$i++){
				// borrar las asignaciones de prod e ingresar de nuevo
				$sql="insert into $tablarelaciones (idorigen,iddestino) values($idx,".$x[$i].")";
			// echo $sql."<br>";
				if ($db->Execute($sql)) $h;
			}
//		if ($h>0) $mensajes.=" y se actualizan sus asociaciones";
		}
?>
