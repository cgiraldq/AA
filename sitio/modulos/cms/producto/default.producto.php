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
//$db->debug = true;
$titulomodulo="Configuraci&oacute;n de servicios";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$idtipo=$_REQUEST['idtipo'];
$letra=$_REQUEST['letra'];
$idtipob=$_REQUEST['idtipob'];
$idactivo=$_REQUEST['idactivo'];
$idactivox=$_REQUEST['idactivox'];

$idnatx=$_REQUEST['idnatx'];
$idsubcatx=$_REQUEST['idsubcatx'];


$idtipoprod=$_REQUEST['idtipoprod'];
if ($idtipoprod=="2") $titulomodulo="Configuracion de Servicio";
if ($idtipoprod=="") $idtipoprod="1";


$tabla="tblproductos";
$orderby=$_REQUEST['orderby'];
$carpeta="producto";
$include="include('../../beta/producto_detalle.php')";
$rutaImagen="../../../contenidos/images/producto/";

$idlanding=$_REQUEST['idlanding'];
// eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");

// insercion
if ($dsm<>"" && $idpos<>"") {
		$idnat=$_REQUEST['idnat'];

		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;
		 } else {
		 	$dsrutax=limpieza(strtolower($dsm));

		 	// insertar
			$idcategoria=0;
			$sql="insert into $tabla (dsm,idpos,idactivo,dsruta)";
			$sql.=" values ('$dsm',$idpos,$idactivo,'$dsrutax') ";
			//echo $sql;
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";

				include($rutxx."../../incluidos_modulos/logs.php");
				$error=0;
			} else {
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
				$error=1;
			}
		 }
		 $result->close();
}

// modificacion rapida
//$db->debug=true;
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo='".$_REQUEST['idactivo_'][$j]."'";
					//$sql.= ",dsreferencia='".$_REQUEST['dsreferencia_'][$j]."'";

					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsruta='".limpieza(strtolower($_REQUEST['dsm_'][$j]))."'";
					//$sql.= ",precio1='".$_REQUEST['precio1_'][$j]."'";
					//$sql.= ",dsunidadesdispo='".$_REQUEST['dsunidadesdispo_'][$j]."'";
					//$sql.= ",preciodistribuidor='".$_REQUEST['preciodistribuidor_'][$j]."'";

					$sql.= ",idcategoria='".$_REQUEST['categorias_'][$j]."'";
					$sql.= ",idpos='".$_REQUEST['idpos_'][$j]."'";
					$sql.= " where id='".$_REQUEST['id_'][$j]."'";
					//echo $sql;
					//$db->debug=true;
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



?><html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	 include($rutxx."../../incluidos_modulos/core.mensajes.php");
	?>

<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.idtipo,a.precio1,a.preciodescuento";
$sql.=",a.iva,a.peso,a.dsimg1,a.idcategoria";
$sql.=" from $tabla a ";
if ($idsubcatx<>"") $sql.=" , tblsubcategoriaxtblproducto b  ";
$sql.=" where a.id>0 and a.idactivo<>9";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
//if ($idtipob<>"") $sql.=" and a.idtipo='".$idtipob."'";
//if ($idactivo<>"") $sql.=" and a.idactivo='".$idactivo."'";
if ($idactivox<>"") $sql.=" and a.idactivo='".$idactivox."'";
if ($idnatx<>"") $sql.=" and a.idnat='".$idnatx."'";
if ($idsubcatx<>"") $sql.=" and b.idorigen=a.id and b.iddestino=$idsubcatx ";

//$sql.=" order by a.id desc ";
//echo $sql;
//$db->debug=true;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";

		$tipob=0; // permite buscar por tipo
		$idnatu=0;
		$idsubcategoria="0";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	//$rutaPaginacion="&idactivo=".$_REQUEST['idactivo']."&idnatx=".$_REQUEST['idnatx']."&idactivox=".$_REQUEST['idactivox'];
	//$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	//$rutaPaginacion.="&idtipob=$idtipob&idsubcatx=$idsubcatx";

	$maxregistros=6;
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='$rutxx../core/default.php' target='_top' class='textlink' title='Principal'>Principal</a>  /  ";
	if ($idtipoprod=="2") $rutamodulo="<a href='../servicios/default.php' class='textlink' title='Principal'>Administracion de Productos</a>  /  ";

	if ($idlanding<>"") {
		$rutamodulo.="<a href='../landingpage/default.php' class='textlink' title='Principal'>Landing Page</a>  /  ";
		$rutamodulo.=" <span class='text1'>Asociando Productos</span> /";

		}
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$importar=2;
		$exportar=2;
		$dsrutaPapelera="papelera.php?idtipoprod=$idtipoprod";//ruta de la papelera
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		include("producto.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("producto.ingreso.php");
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>