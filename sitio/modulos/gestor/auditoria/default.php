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
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Listado de acciones realizadas en el administrador";
$letra=$_REQUEST['letra'];
$tabla="tbl_logs";
// insercion
// eliminacion
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	include($rutxx."../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados


$sql="select a.dsusuario,a.dsmodulo,a.dstitulo,a.dsip,a.dsdesc,a.dsfecha";
$sql.=" from $tabla a where id>0 ";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['paramx']<>""){
 $sql.=" and a.".$_REQUEST['campox']."='".$_REQUEST['paramx']."'";
 if($_REQUEST['fechain']<>"" && $_REQUEST['fechafi']<>"")
		{
			$partirx=explode("/",$_REQUEST['fechain']);
			$fechain=$partirx[0].$partirx[1].$partirx[2];
			$partirx=explode("/",$_REQUEST['fechafi']);
			$fechafi=$partirx[0].$partirx[1].$partirx[2];

			$sql.=" and idfecha between '".$fechain."'";
			$sql.=" and '".$fechafi."'";
		}
}
elseif($_REQUEST['param2']<>"")
{
	$sql.=" and dsmodulo like '%".$_REQUEST['param2']."%'";
		if($_REQUEST['fechain']<>"" && $_REQUEST['fechafi']<>"")
		{
			$partirx=explode("/",$_REQUEST['fechain']);
			$fechain=$partirx[0].$partirx[1].$partirx[2];
			$partirx=explode("/",$_REQUEST['fechafi']);
			$fechafi=$partirx[0].$partirx[1].$partirx[2];

			$sql.=" and idfecha between '".$fechain."'";
			$sql.=" and '".$fechafi."'";
		}
}
else{
if ($_REQUEST['param']<>""){
	$sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
	if($_REQUEST['fechain']<>"" && $_REQUEST['fechafi']<>"")
		{
			$partirx=explode("/",$_REQUEST['fechain']);
			$fechain=$partirx[0].$partirx[1].$partirx[2];
			$partirx=explode("/",$_REQUEST['fechafi']);
			$fechafi=$partirx[0].$partirx[1].$partirx[2];

			$sql.=" and idfecha between '".$fechain."'";
			$sql.=" and '".$fechafi."'";
		}
	}
	else
	{
		if($_REQUEST['fechain']<>"" && $_REQUEST['fechafi']<>"")
		{
			$partirx=explode("/",$_REQUEST['fechain']);
			$fechain=$partirx[0].$partirx[1].$partirx[2];
			$partirx=explode("/",$_REQUEST['fechafi']);
			$fechafi=$partirx[0].$partirx[1].$partirx[2];

			$sql.=" and idfecha between '".$fechain."'";
			$sql.=" and '".$fechafi."'";
		}
	}
}
//echo $sql;
$sql.=" order by a.id desc  ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsusuario";
		// 2. los tipo de busqueda
		$paramb="dsusuario,dsmodulo,dstitulo";
		$paramn="Usuario,Modulo,Accion,Descripcion";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	//$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");

	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$exportar=1; // permite exportar la tabla
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("auditoria.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
		echo "<br>";
	} // fin si
$result->Close();
			include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>