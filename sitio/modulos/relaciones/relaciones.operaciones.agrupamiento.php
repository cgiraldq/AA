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
		$sel=$_REQUEST['sel'];
		$contar=count($sel);

		$idposagrupamiento=$_REQUEST['pos'];


		if ($_REQUEST['paso']==1){

		$sql="delete from $tablarelaciones where idorigen=$idx";
		$db->Execute($sql);

		//$sqlx="delete from $tablarelacionesxtemas where iddestino=$idx and idagrupamiento='".$_REQUEST['idx']."' ";
		//$db->Execute($sql);

			for ($i=0;$i<$contar;$i++){
				// borrar las asignaciones de prod e ingresar de nuevo
				$x=$sel[$i];
				 $nombrevar="select_$x";
				 $select=$_REQUEST[$nombrevar];
				$sql="delete from $tablarelacionesxtemas where iddestino='".$sel[$i]."' and idagrupamiento='".$_REQUEST['idx']."' ";

				if($select<>""){
						$idposn=$idposagrupamiento[$x[$i]];
						if($idposn=="") $idposn=999;
					$sql="insert into $tablarelaciones (idorigen,iddestino,idpos) values($idx,'".$sel[$i]."','".$idposn."')";
				}

			//echo $sql."<br>";
				if ($db->Execute($sql)) $h;
			}
//		if ($h>0) $mensajes.=" y se actualizan sus asociaciones";
		}
?>
