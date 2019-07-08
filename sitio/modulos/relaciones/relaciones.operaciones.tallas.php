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
		$x=$_REQUEST['sel4'];
		$dsprecio_sel1=$_REQUEST['dsprecio_sel1'];
		$dsprecio_sel2=$_REQUEST['dsprecio_sel2'];
		$dsprecio_sel3=$_REQUEST['dsprecio_sel3'];
		$dsprecio_sel4=$_REQUEST['dsprecio_sel4'];
		$dsprecio_sel5=$_REQUEST['dsprecio_sel5'];
		$param="dsprecio1,dsprecio2,dsprecio3,dsprecio4,dsprecio5";
		$contar=count($x);	
		$sql="delete from $tablarelaciones4 where idorigen=$idx";
		$db->Execute($sql);
		if ($contar> 0){
		$h=0;
			for ($i=0;$i<$contar;$i++){
				if($dsprecio_sel1[$i]=="")$dsprecio_sel1[$i]=$precio1;
				if($dsprecio_sel2[$i]=="")$dsprecio_sel2[$i]=$precio2;
				if($dsprecio_sel3[$i]=="")$dsprecio_sel3[$i]=$precio3;
				if($dsprecio_sel4[$i]=="")$dsprecio_sel4[$i]=$precio4;
				if($dsprecio_sel5[$i]=="")$dsprecio_sel5[$i]=$precio5;
				$sql="insert into $tablarelaciones4 (idorigen,iddestino,$param) values($idx,".$x[$i].",'".$dsprecio_sel1[$i]."','".$dsprecio_sel2[$i]."','".$dsprecio_sel3[$i]."','".$dsprecio_sel4[$i]."','".$dsprecio_sel5[$i]."')";
				if ($db->Execute($sql)) $h++;
			}				
		if ($h>0)$mensajes.=" y se actualizan sus asociaciones con las tallas";
		}
?>
