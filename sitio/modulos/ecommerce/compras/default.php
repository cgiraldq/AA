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
  Juan Fernando Fernandez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sanchez <graficoweb@comprandofacil.com> - Diseno
  Jose Fernando Pena <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// principal
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$titulomodulo="Configuracion de las compras";
$letra=$_REQUEST['letra'];
$tabla="ecommerce_tblpagos";
$orderby=$_REQUEST['orderby'];
$dsfechasel=$_REQUEST['dsfechasel'];
$idproducto=$_REQUEST['idproducto'];
$dsproducto=$_REQUEST['dsproducto'];
$idtiendax=$_REQUEST['idtiendax'];
$idcliente=$_REQUEST['idcliente'];
//
//$db->debug=true;
include("default.procesos.php"); // los procesos de cambios de estados del pedido
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsciudadflete,a.dssubtotal,a.dsflete";
$sql.=",a.dsiva,a.dstotal,a.idestado,a.dsfecha,a.dsformadepago,a.idcliente,a.idtipocomp";
$sql.=",a.idpedido,a.idclientepago,a.dsdescuento,a.dsfechalarga,a.dscampo1,a.idtienda";
$sql.=" from $tabla a ";
if ($idproducto<>"") $sql.=", ecommerce_tblcompras b ";
$sql.=" where a.id>0 ";//and idestado<>0";
$sql.=" ";//echo $sql; 
if ($idproducto<>"") $sql.=" and b.idpedido=a.idpedido and b.idproducto=$idproducto ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($_REQUEST['fechain']<>"" && $_REQUEST['fechafi']<>"") $sql.=" and a.$dsfechasel  between '".$_REQUEST['fechain']."' and '".$_REQUEST['fechafi']."'";
if($_REQUEST['idestado']<>"")$sql.=" and a.idestado=".$_REQUEST['idestado'];
if($_REQUEST['dstipopago']<>"")$sql.=" and a.dsformadepago='".$_REQUEST['dstipopago']."'";
if($_REQUEST['idafiliado']<>"")$sql.=" and a.idafiliado=".$_REQUEST['idafiliado'];
if($_REQUEST['idcliente']<>"")$sql.=" and a.idclientepago=".$_REQUEST['idcliente'];
if($_REQUEST['idtiendax']<>"")$sql.=" and a.idtienda=".$_REQUEST['idtiendax'];
if ($orderby<>"") { 
	$sql.=" order by a.$orderby asc ";
} else { 
	$sql.=" order by a.id desc ";
}


		// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="idpedido";
		// 2. los tipo de busqueda
		$paramb="idpedido";
		$paramn="Pedido";
		$info="vencimiento";
		$mostrarbotones=1;	
		include($rutxx."../../incluidos_modulos/modulos.buscador.compras.php");
	// fin modulo buscador

	$maxregistrosx=100;
	$rutaPaginacion="idcliente=".$_REQUEST['idcliente']."&param=".$_REQUEST['param'];
	$rutaPaginacion.="&idestado=$idestado&dsproducto=$dsproducto&idproducto=$idproducto";
	$rutaPaginacion.="&$dsfechasel=$dsfechasel&campo=".$_REQUEST['campo'];
	$rutaPaginacion.="&letra=".$_REQUEST['letra']."&idafiliado=".$_REQUEST['idafiliado'];
	$rutaPaginacion.="&idtiendax=".$_REQUEST['idtiendax'];

	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.="<span class='text1'>".$titulomodulo."</span>";
	if ($idproducto<>"")   $rutamodulo.=" / <a href='../compras/default.consolidados.confirmados.php' class='textlink' title='Regresar'>Regresar a Productos Consolidados Confirmados</a>  /  ";

  $rutamodulo.=" / <a href='../compras/default.consolidados.confirmados.php' class='textlink' title='Consolidado'>Productos Consolidados Confirmados</a>  /  ";


	if ($idproducto<>"")   $rutamodulo.="  Resultados al buscar el producto $dsproducto   ";
	if ($idtiendax<>"")   $rutamodulo.="  TIENDA SELECCIONADA:   ".seldato("dsnombre","id","tblempresa",$idtiendax,1);

  
  $papelera=0;
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

	if (!$result->EOF) {
		
		include("compras.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si 
$result->Close();
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>
<script language="javascript">
<!--
function cambiar_pedido(forma,campo) {
  location.href=eval("document."+forma+"."+campo+".value");
}
//-->
</script>