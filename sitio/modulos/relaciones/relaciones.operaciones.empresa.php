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
		$x=$_REQUEST['sel2'];
		$contar=count($x);		

		$sql="delete from $tablarelaciones2 where idorigen=$idx";
		$db->Execute($sql);

		if ($contar> 0){
		$h=0;
			for ($i=0;$i<$contar;$i++){
				// borrar las asignaciones de prod e ingresar de nuevo
				$sql="insert into $tablarelaciones2 (idorigen,iddestino) values($idx,".$x[$i].")";
				// echo $sql."<br>";
				if ($db->Execute($sql)) $h++;
			}				
		if ($h>0)$mensajes.=" y se actualizan sus asociaciones con las tiendas";
		}
?>
