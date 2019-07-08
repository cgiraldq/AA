<?
$rutx=1;
$rutxx="../";

$tipox=$_REQUEST['tipox'];
$paramx=$_REQUEST['paramx'];
$paramxf=preg_replace("/ /","_",$paramx);

$idtv=$_REQUEST['idtv'];
$grafica=$_REQUEST['grafica'];
$totalvotos=$_REQUEST['totalvotos'];

$zona=$_REQUEST['zona'];
$zonaf=preg_replace("/ /","_",$zona);

if ($zona<>"") $paramx.=", zona ".$zona;
$titulomodulo="Detalle de ".$paramx;
// colores para grafica
$fondoE[1]="background='img/fondo_naranja.gif' bgcolor='#FF9900'";
$fondoE[2]="background='img/fondo_verde.gif' bgcolor='#00CC33'";
$fondoE[3]="background='img/fondo_azul1.gif' bgcolor='#0074C5'";
$fondoE[4]="background='img/fondo_rojo.gif' bgcolor='#CC0000'";
$fondoE[5]="background='img/fondo_amrillo.gif' bgcolor='#CC0000'";
$fondoE[6]="background='img/fondo_morado.gif' bgcolor='#CC0000'";
$fondoE[7]="background='img/fondo_grisgif.gif' bgcolor='#CC0000'";
$fondoE[8]="background='img/fondo_naranja.gif' bgcolor='#FF9900'";
$fondoE[9]="background='img/fondo_verde.gif' bgcolor='#00CC33'";
$fondoE[10]="background='img/fondo_azul1.gif' bgcolor='#0074C5'";
$fondoE[11]="background='img/fondo_rojo.gif' bgcolor='#CC0000'";
$fondoE[12]="background='img/fondo_amrillo.gif' bgcolor='#CC0000'";
$fondoE[13]="background='img/fondo_naranja.gif' bgcolor='#FF9900'";
$fondoE[14]="background='img/fondo_verde.gif' bgcolor='#00CC33'";
$fondoE[15]="background='img/fondo_azul1.gif' bgcolor='#0074C5'";
$fondoE[16]="background='img/fondo_rojo.gif' bgcolor='#CC0000'";
$fondoE[17]="background='img/fondo_amrillo.gif' bgcolor='#CC0000'";
$fondoE[18]="background='img/fondo_morado.gif' bgcolor='#CC0000'";
$fondoE[19]="background='img/fondo_grisgif.gif' bgcolor='#CC0000'";
$fondoE[20]="background='img/fondo_naranja.gif' bgcolor='#FF9900'";
$fondoE[21]="background='img/fondo_verde.gif' bgcolor='#00CC33'";
$fondoE[22]="background='img/fondo_azul1.gif' bgcolor='#0074C5'";
$fondoE[23]="background='img/fondo_rojo.gif' bgcolor='#CC0000'";
$fondoE[24]="background='img/fondo_amrillo.gif' bgcolor='#CC0000'";
// fin colores para grafica
if ($_REQUEST['enviar']=="Exportar") { 
		header("Content-type: application/octet-stream");
		$nombre="".$paramxf."_".$zonaf."_".date("ymdhis").".xls";
		header("Content-Disposition: attachment; filename=$nombre");
		header("Pragma: no-cache");
		header("Expires: 0");
}
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
*/
// detalle del informe
include($rutxx."../../incluidos_modulos/version.php");
include($rutxx."../../incluidos_modulos/comunes.php");
include($rutxx."../../incluidos_modulos/varconexion.php");
include($rutxx."../../incluidos_modulos/modulos.funciones.php");
include($rutxx."../../incluidos_modulos/sql.injection.php");
include($rutxx."../../incluidos_modulos/sessiones.php");
include($rutxx."../../incluidos_modulos/varmensajes.php");
include($rutxx."../../incluidos_modulos/class.rc4crypt.php");
include($rutxx."../../incluidos_modulos/bloqueo.ip.php");
if ($_REQUEST['enviar']<>"Exportar") { 
?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<? include($rutxx."../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
}
?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<tr>

<td align="left">
<? echo $paramx?>
</td>
<td align="right">
<? if ($_REQUEST['enviar']<>"Exportar") { ?>
	<strong>
	<a href="<? echo $pagina?>?tipox=<? echo $tipox?>&paramx=<? echo $_REQUEST['paramx']?>&idtv=<? echo $idtv?>&zona=<? echo $zona?>&grafica=<? echo $grafica?>&totalvotos=<? echo $totalvotos?>&enviar=Exportar">Exportar Datos</a>
	|
	<a href="javascript:window.close();">Cerrar</a>
	</strong>
<? } ?>
</td>


</tr>
</table>
<?
if ($tipox=="totala") {
	$sql="select a.idnits,a.dsnombre,a.dscodigoasociado,a.dszonaelectoral from tblvotacionasociados_temp a, tblvotacionasociados b where 1 ";
	$sql.=" and b.dscodigo=a.dscodigo ";
	if ($zona<>"") $sql.=" and a.dszonaelectoral='".$zona."'";
	if ($idtv<>"") $sql.=" and b.idtipov='".$idtv."'";
	
	if ($zona<>"")  { 
		$sql.=" order by a.dsnombre asc ";	
	} else { 
		$sql.=" order by a.dszonaelectoral asc, a.dsnombre asc ";
	}
} elseif ($tipox=="totalc") { 
	$sql="select a.idnits,b.dsasociado,a.dscodigoasociado,b.idzona,b.fecharegistro from tblvotacionasociados_temp a, tblcandidatos b where 1 ";
	$sql.=" and b.dscedula=a.dscodigo and b.idactivo<>999 ";
	if ($zona<>"") $sql.=" and b.idzona='".$zona."'";
	if ($idtv<>"") $sql.=" and b.idtipov='".$idtv."'";

	if ($zona<>"")  { 
		$sql.=" order by b.id asc ";	
	} else { 
		$sql.=" order by b.idzona asc, b.id asc ";
	}
	//echo $sql;
	
} elseif ($tipox=="totalv") {  // total votaciones ordenadas por el mayor encontrado

	$sql="select a.idnits,b.dsasociado,a.dscodigoasociado,b.idzona,b.fecharegistro,count(*) as votos";
	$sql.="	from tblvotacionasociados_temp a, tblcandidatos b, tblvotacionresultados_votos c";
	$sql.=" where 1 ";
	
	$sql.=" and (b.idasociado=a.idnits or b.dscedula=a.dscodigo) and b.idactivo<>999 and c.idcandidato=b.idasociado ";
	if ($zona<>"") $sql.=" and b.idzona='".$zona."'";
	if ($idtv<>"") $sql.=" and c.idtipov='".$idtv."' and b.idtipov='".$idtv."'";
	
	$sql.=" group by a.idnits,b.dsasociado,a.dscodigoasociado,b.idzona,b.fecharegistro  ";

	$sql.=" order by votos desc  ";
	
	//echo $sql;
	
} elseif ($tipox=="totalb") {  // totalvotaciones en blanco

	$sql="select a.idnits,a.dsnombre,a.dscodigoasociado,c.dszona,c.dsfecha ";
	$sql.="	from tblvotacionasociados_temp a, tblvotacionresultados_votos c";
	$sql.=" where 1 ";
	
	$sql.=" and c.dstipo='VOTO EN BLANCO' and c.dscodigo=a.dscodigo ";
	if ($zona<>"") $sql.=" and c.dszona='".$zona."'";
	if ($idtv<>"") $sql.=" and c.idtipov='".$idtv."'";
	
	
	
	if ($zona<>"")  { 
		$sql.=" order by c.id asc ";	
	} else { 
		$sql.=" order by c.dszona asc, c.id asc ";
	}
	
	
} elseif ($tipox=="hanvotado") {  // han votado
	
	$sql="select a.idnits,a.dsnombre,a.dscodigoasociado,c.dszona,count(*) as votos ";
	$sql.="	from tblvotacionasociados_temp a, tblvotacionresultados_votos c";
	$sql.=" where 1 ";
	
	$sql.=" and c.dscedula=a.dscodigo ";
	if ($zona<>"") $sql.=" and c.dszona='".$zona."'";
	if ($idtv<>"") $sql.=" and c.idtipov='".$idtv."'";
	
	$sql.=" group by a.idnits,a.dsnombre,a.dscodigoasociado,c.dszona ";
	
	if ($zona<>"")  { 
		$sql.=" order by a.dsnombre asc ";	
	} else { 
		$sql.=" order by c.dszona asc, a.dsnombre asc ";
	}
	
} elseif ($tipox=="totalnv") {  // no han votado
	$sql="select a.idnits,a.dsnombre,a.dscodigoasociado,a.dszonaelectoral from tblvotacionasociados_temp a, tblvotacionasociados b where 1 ";
	$sql.=" and b.dscodigo=a.dscodigo ";
	if ($zona<>"") $sql.=" and a.dszonaelectoral='".$zona."'";
	if ($idtv<>"") $sql.=" and b.idtipov='".$idtv."'";
	
	if ($zona<>"")  { 
		$sql.=" order by a.dsnombre asc ";	
	} else { 
		$sql.=" order by a.dszonaelectoral asc, a.dsnombre asc ";
	}
	
}
//echo $sql;
//exit();
$result=$db->Execute($sql);
	if (!$result->EOF) {
				include("informes.detalle.tabla.php");
	} // fin si 
$result->Close();
 	
?>

</body>
</html>
