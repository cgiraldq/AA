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
*/	// $db->debug=true;
		$x=$_REQUEST['selx'];
		$contar=count($x);
		if ($_REQUEST['paso']==1){
		$sql="delete from tbltblproductoxcategoria  where idorigen=$idx";
		$db->Execute($sql);
		$h=0;
			for ($i=0;$i<$contar;$i++){
				// borrar las asignaciones de prod e ingresar de nuevo
				$sql="insert into tbltblproductoxcategoria  (idorigen,iddestino) values($idx,".$x[$i].")";
				 //echo $sql."<br>";
				if ($db->Execute($sql)) $h++;
			}
		if ($h>0)$mensajes.=" y se actualizan sus asociaciones";
		}

		 //$db->debug=false;
?>
