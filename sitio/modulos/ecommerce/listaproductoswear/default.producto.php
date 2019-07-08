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
include("../../../incluidos_modulos/modulos.globales.php");
// $db->debug=true;
$titulomodulo="Configuracion de Producto wear";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$idtipo=$_REQUEST['idtipo'];
$letra=$_REQUEST['letra'];
$dsreferenciax=$_REQUEST['dsreferenciax'];
$idtipob=$_REQUEST['idtipob'];
$idactivo=$_REQUEST['idactivo'];
$idactivox=$_REQUEST['idactivox'];
$ordenar=$_REQUEST['ordenar'];
$idnatx=$_REQUEST['idnatx'];
$idsubcatx=$_REQUEST['idsubcatx'];
$tabla="ecommerce_tblproductos";
$orderby=$_REQUEST['orderby'];
$carpeta="producto";
$include="include('../../beta/producto_detalle.php')";
$rutaImagen="../../../../contenidos/images/ecommerce_productos/";
$idlanding=$_REQUEST['idlanding'];
// insercion
if ($dsm<>"" && $idpos<>"") {
		$idnat=$_REQUEST['idnat'];
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
		 	$error=1;
			$mensajes=$men[0];
		 } else {
		 	$dsruta=limpieza(strtolower($dsm));
		 	// insertar
			$idcategoria=0;
			$sql="insert into $tabla (dsm,idpos,dsreferencia,idactivo,dsruta,idtipo)";
			$sql.=" values ('$dsm','$idpos','$dsreferenciax','$idactivo','$dsruta',3) ";
			if ($db->Execute($sql))  {
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../ecommerce/listaproductos/default.php?idtipoprod=$idtipoprod";
				include($rutxx."../../incluidos_modulos/logs.php");

			} else {
				$error=1;
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
			}
		 }
		 $result->close();
}
// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
// modificacion rapida
//$db->debug=true;
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$dsrutamiga=limpieza(strtolower($_REQUEST['dsm_'][$j]));
					if ($_REQUEST['dsreferencia_'][$j]<>"")$dsrutamiga.="_".$_REQUEST['dsreferencia_'][$j];
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsreferencia='".$_REQUEST['dsreferencia_'][$j]."'";
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsruta='".$dsrutamiga."'";
					$sql.= ",dsunidadesdispo='".$_REQUEST['dsunidadesdispo_'][$j]."'";
					$sql.= ",idpos='".$_REQUEST['idpos_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
				if ($db->Execute($sql)) $h++;
				} // fin si
			}
if ($_REQUEST['idx_']<>"") {
		$sql="delete  from tbllanding_page_productos where idlanding=$idlanding and idtipo=1";
		$db->Execute($sql);
		$contarx=count($_REQUEST['idx_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['idx_'][$j]<>"" && $_REQUEST['idactivox_'][$j]<>""){
					$sql=" insert into  tbllanding_page_productos ";
					$sql.= " (idlanding,idprodcat,idtipo,idactivo)";
					$sql.=" values ";
					$sql.= " ($idlanding,".$_REQUEST['idx_'][$j].",1,".$_REQUEST['idactivox_'][$j].")";
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
}
	if ($h>0) $mensajes=$men[4];

// busquedas
$sinprecio=$_REQUEST['sinprecio'];
$sintrans=$_REQUEST['sintrans'];
$sindescuento=$_REQUEST['sindescuento'];
$sinimagen=$_REQUEST['sinimagen'];
$sinimagen_1=$_REQUEST['sinimagen_1'];
$sinref=$_REQUEST['sinref'];
$sindesc=$_REQUEST['sindesc'];
$siniva=$_REQUEST['siniva'];
$idmarca=$_REQUEST['idmarca'];

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.idtipo,a.precio1,a.preciodescuento";
$sql.=",a.iva,a.peso,a.dsimg1,a.idnat,a.dsreferencia,a.preciodistribuidor,a.dsunidadesdispo";
$sql.=" from $tabla a ";
if ($idsubcatx<>"") $sql.=" , ecommerce_tblsubcategoriaxtblproducto b, ecommerce_tblsubcategoriasxcategoria c  ";
$sql.=" where a.id>0 and a.idactivo<>9 and a.idtipo=3";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
//if ($idtipob<>"") $sql.=" and a.idtipo='".$idtipob."'";
if ($idactivo<>"") $sql.=" and a.idactivo='".$idactivo."'";
if ($idactivox<>"") $sql.=" and a.idactivo='".$idactivox."'";
if ($idnatx<>"") $sql.=" and a.idnat='".$idnatx."'";
if ($idsubcatx<>"") $sql.=" and (b.iddestino=c.id or c.dsm=b.dscategoria)  and (b.idorigen=a.id ) and (b.iddestino=$idsubcatx or c.id=$idsubcatx) ";

if ($sinprecio==1) $sql.=" and (a.precio1='' or a.precio1 is null or a.precio1=0) ";
if ($sinprecio==2) $sql.=" and (a.precio2='' or a.precio2 is null or a.precio2=0) ";
if ($sinprecio==3) $sql.=" and (a.precio3='' or a.precio3 is null or a.precio3=0) ";
if ($sinprecio==4) $sql.=" and (a.precio4='' or a.precio4 is null or a.precio4=0) ";
if ($sinprecio==5) $sql.=" and (a.precio5='' or a.precio5 is null or a.precio5=0) ";
if ($sintrans<>"") $sql.=" and (a.dsflete='' or a.dsflete is null or a.dsflete=0) ";
if ($siniva==1) $sql.=" and (a.iva='' or a.iva is null or a.iva=0) ";
if ($idmarca<>""){
	$dsmarca=seldato('dsm','id','ecommerce_tblmarcas',$idmarca,1);
	$sql.=" and ( idmarca=$idmarca or dsmarca='$dsmarca') ";
} 
if ($sindesc<>"") $sql.=" and (dsd='' or dsd is null) ";
if ($sinref<>"") $sql.=" and (dsreferencia='' or dsreferencia is null) ";
if($ordenar==1||$ordenar=="")$sql.=" order by a.dsm asc ";
if($ordenar==2)$sql.=" order by a.dsm desc ";
if($ordenar==4)$sql.=" order by a.precio1 asc ";
if($ordenar==3)$sql.=" order by a.precio1 desc ";
if($ordenar==5)$sql.=" order by a.dsreferencia asc ";
if($ordenar==6)$sql.=" order by a.dsreferencia desc ";
//echo $sql;

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm,dsreferencia";
		$paramn="Nombre,Referencia";
		$tipob=1; // permite buscar por tipo
		$idnatu=1;
		$ordenar=1;
		$idsubcategoria="1";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idactivo=".$_REQUEST['idactivo']."&idnatx=".$_REQUEST['idnatx']."&idactivox=".$_REQUEST['idactivox'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$rutaPaginacion.="&idtipob=$idtipob&idsubcatx=$idsubcatx";
	$rutaPaginacion.="&sinprecio=$sinprecio&sintrans=$sintrans";
	$rutaPaginacion.="&sindescuento=$sindescuento&sinimagen=$sinimagen&sinimagen_1=$sinimagen_1";
	$rutaPaginacion.="&sinref=$sinref&sindesc=$sindesc";
	$rutaPaginacion.="&ordenar=$ordenar";
	$rutaPaginacion.="&idmarca=$idmarca";	
	$rutaPaginacion.="&campoletra=".$_REQUEST['campoletra'];

	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../productos/default.php' class='textlink' title='Principal'>Administracion de Productos</a>  /  ";
	if ($idtipoprod=="2") $rutamodulo="<a href='../servicios/default.php' class='textlink' title='Principal'>Administracion de Servicios</a>  /  ";

	if ($idlanding<>"") {
		$rutamodulo.="<a href='../landingpage/default.php' class='textlink' title='Principal'>Landing Page</a>  /  ";
		$rutamodulo.=" <span class='text1'>Asociando Productos</span> /";

		}
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$importar=1;
		$exportar=1;
		$dsrutaPapelera="papelera.php?idtipoprod=$idtipoprod";//ruta de la papelera
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
if ($idlanding<>"") {
	$result=$db->Execute($sql);
	if (!$result->EOF) {
		include("producto.landingpage.tabla.php");
	}
	$result->Close();
} else {
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		include("producto.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("producto.ingreso.php");
}
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>