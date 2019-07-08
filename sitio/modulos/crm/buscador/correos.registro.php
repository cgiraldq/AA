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
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
//include("../../incluidos_modulos/bloqueo.ip.php");

$titulomodulo="Listado de Preguntas";
$letra=$_REQUEST['letra'];
$dsm=$_REQUEST['dsm'];
$tabla="tblbuscador";
$tipo=$_REQUEST['tipo'];
// insercion
// eliminacion
$idx=$_REQUEST['idx'];
if ($idx<>"") { 
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  { 
		$mensajes="<strong>".$men[3]."</strong>";
		$dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de $titulomodulo de $dsm";
		$dsruta="../reservas/default.php";
		include("../../incluidos_modulos/logs.php");
		
	}	
}
/*if($_REQUEST['enviar']=="Confirmar")
{
		$sqla="update $tabla set idactivo='Confirmado'";
		$sqla.=" where id=".$idc;
		//echo $sqla;
		if ($db->Execute($sqla)){
		$mensajes=$men[8];
		$dstitulo="Confirmar $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." confirmo registro de $titulomodulo de $dsm";
		$dsruta="../reservas/default.php";
		include("../../incluidos_modulos/logs.php");
		}
}
if($_REQUEST['enviar']=="Cancelar")
{
	$sqla="update $tabla set idactivo='Cancelado'";
		$sqla.=" where id=".$idc;
		//echo $sqla;
		if ($db->Execute($sqla)){
		$mensajes=$men[9];
		$dstitulo="Cancelar $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." concelo registro de $titulomodulo de $dsm";
		$dsruta="../reservas/default.php";
		include("../../incluidos_modulos/logs.php");
		}
}*/

?>
<html>
<head>
<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsnombre";
$sql.=",a.dscorreocliente,a.dscom,a.dsfecha,a.dsreferido,a.dsremoto";
if($tipo==2)$sql.=",b.dsm ";
if($tipo==3)$sql.=",b.dsm,b.dsapellido ";
$sql.=" from $tabla a ";
if($tipo==2)$sql.=" left join tblafiliados b on a.idcontacto=b.id ";
if($tipo==3)$sql.=" left join tblfuncionarios b on a.idcontacto=b.id ";
$sql.=" where a.id>0 and a.idtipo=$tipo";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
$sql.=" order by a.id desc  ";
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
		$paramb="dsnombre,dsmail,dscom";
		$paramn="Nombre,Email,Pregunta";
		include("../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	//$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
	$rutaPaginacion="dsm=".$_REQUEST['dsm'];
	include("../../incluidos_modulos/paginar.variables.php");
	
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.="<a href='../correos/default.php' class='textlink' title=''>Configuracion de correos</a>  /  <span class='text1'>".$titulomodulo."</span>";
		$exportar=1; // permite exportar la tabla
		$parametros="?tipo=".$tipo;
		include("../../incluidos_modulos/modulos.subencabezado.php");
		include("correos.registro.tabla.php");
		include("../../incluidos_modulos/paginar.php");
		echo "<br>";
	} // fin si 
$result->Close();
	include("../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>