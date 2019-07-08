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
		$x=$_REQUEST['sel'];
		$contar=count($x);		
		if ($contar> 0){
		$sql="delete from $tablarelaciones where idprod=$idx";
		$db->Execute($sql);
		$h=0;
			for ($i=0;$i<$contar;$i++){
				// borrar las asignaciones de prod e ingresar de nuevo
				$sql="insert into $tablarelaciones (idprod,iduso) values($idx,".$x[$i].")";
				// echo $sql."<br>";
				if ($db->Execute($sql)) $h++;
			}				
		if ($h>0)$mensajes.=" y se actualizan sus asociaciones";
		}
?>
