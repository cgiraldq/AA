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

$titulomodulo="Configuracion de Producto";
$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$idtipo=$_REQUEST['idtipo'];
$letra=$_REQUEST['letra'];
$idtipob=$_REQUEST['idtipob'];
$idactivox=$_REQUEST['idactivox'];

if ($idactivox<>12 || $idactivo<>12) {
?>
<script language="javascript">
<!--
location.href="default.producto.php?idactivox="+<? echo $idactivox?>;
//-->
</script>
<?
}
$idpubcorreox=$_REQUEST['idpubcorreox'];

$idnatx=$_REQUEST['idnatx'];

$idtipoprod=$_REQUEST['idtipoprod'];
if ($idtipoprod=="2") $titulomodulo="Configuracion de Servicio";
if ($idtipoprod=="") $idtipoprod="1";


$tabla="ecommerce_tblproductos";
$orderby=$_REQUEST['orderby'];
$carpeta="producto";
$include="include('../../tienda/productos.detalle.php')";
$rutaImagen="../../../contenidos/images/productos/";
$idlanding=$_REQUEST['idlanding'];
// insercion
if ($dsm<>"" && $idpos<>"") {
		$idnat=$_REQUEST['idnat'];

		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
		 } else {

		 	// insertar
			$idcategoria=0;
			$sql="insert into $tabla (dsm,idpos,idactivo,idtipo,idnat,idtipoprod)";
			$sql.=" values ('$dsm',$idpos,$idactivo,$idtipo,$idnat,$idtipoprod) ";
			if ($db->Execute($sql))  {
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../productos/default.php?idtipoprod=$idtipoprod";
				include($rutxx."../../incluidos_modulos/logs.php");


						$sqld="select id,dsm from $tabla where dsm='".$dsm."'";
						$resultd = $db->Execute($sqld);
						if (!$resultd->EOF) {
						$idr=$resultd->fields[0];
						$dsmr=$resultd->fields[1];
						}

						$dsarchivo=limpieza(strtolower($dsmr)).".php";
						$cuerpo='productos';
						$ruta=$cuerpo."/".$dsarchivo;
						$idreg=$idr;
						$rutax=1;
						$idcategoria=$_REQUEST['idcategoria'];
						if ($idsubcategoria=="") $idsubcategoria=0;
						if ($idmarca=="") $idmarca=0;

						$include="include('".$rutacomunes."/productos.detalle.php')";
						include($rutxx."../../incluidos_modulos/modulos.constructor.php") ;
						$sqlu="update $tabla set dsruta='".$dsruta."' where id=$idreg";
						$resultu = $db->Execute($sqlu);

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
//print_r($_REQUEST['pSelect_']);

//$db->debug=true;
		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";

					$sql.="dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.=" ,dsreferencia='".$_REQUEST['dsreferencia_'][$j]."'";

					$dsfechainicial=$_REQUEST['dsfechainicial_'];
					$dsfechainicial=$dsfechainicial[$j];
					if ($dsfechainicial<>"") {
						$idfechainicial = str_replace("/", "", $dsfechainicial);
						$sql.= ",dsfechainicial='".$dsfechainicial."'";
						$sql.= ",idfechainicial=".$idfechainicial."";
					}else{
						$idfechainicial=0;
					}

					$dsfechafinal=$_REQUEST['dsfechafinal_'];
					$dsfechafinal=$dsfechafinal[$j];
					if ($dsfechafinal<>"") {
						$idfechafinal = str_replace("/", "", $dsfechafinal);
						$sql.= " ,dsfechafinal='".$dsfechafinal."'";
						$sql.= " ,idfechafinal=".$idfechafinal."";
					}else{
						$idfechafinal=0;
					}

					$idpos= $_REQUEST['idpos_'][$j];
					if ($idpos=="")$idpos=$j;
					$sql.= " ,idpos=".$idpos."";

					$sql.=" ,precio1='".$_REQUEST['precio1_'][$j]."'";
					$sql.=" ,preciodescuento='".$_REQUEST['preciodescuento_'][$j]."'";
					$sql.=" ,iva='".$_REQUEST['iva_'][$j]."'";
					$sql.=" ,preciocompra='".$_REQUEST['preciocompra_'][$j]."'";
					$sql.=" ,precio2='".$_REQUEST['precio2_'][$j]."'";
					$sql.=" ,idproveedor='".$_REQUEST['idproveedor_'][$j]."'";
					$sql.=" ,idmarca='".$_REQUEST['idmarca_'][$j]."'";
					if (isset($_REQUEST['pSelect_'][$j])) {
						$sql.= " ,idactivo=".$_REQUEST['idactivo'];

						$dsfechainicial=$_REQUEST['dsfechainicialg'];
						if ($dsfechainicial<>"") {
							$idfechainicial = str_replace("/", "", $dsfechainicial);
							$sql.= ",dsfechainicial='".$dsfechainicial."'";
							$sql.= ",idfechainicial=".$idfechainicial."";
						}else{
							$idfechainicial=0;
						}

						$dsfechafinal=$_REQUEST['dsfechafinalg'];
						if ($dsfechafinal<>"") {
							$idfechafinal = str_replace("/", "", $dsfechafinal);
							$sql.= " ,dsfechafinal='".$dsfechafinal."'";
							$sql.= " ,idfechafinal=".$idfechafinal."";
						}else{
							$idfechafinal=0;
						}

					}
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql;
					if ($db->Execute($sql)){

					}
				} // fin si
			} // fin for
					//exit();
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
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsreferencia,a.dsm,a.dsfechainicial,a.dsfechafinal,a.idpos,a.idactivo,a.precio1,a.preciodescuento,a.iva,a.preciocompra,a.precio2,a.idproveedor,a.idmarca";
$sql.=" from $tabla a where id>0 and idactivo=12";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
if ($idtipob<>"") $sql.=" and a.idtipo='".$idtipob."'";
if ($idactivox<>"") $sql.=" and a.idactivo='".$idactivox."'";
if ($idpubcorreox<>"") $sql.=" and a.idpubcorreo='".$idpubcorreox."'";
if ($idtipoprod<>"") $sql.=" and a.idtipoprod='".$idtipoprod."'";
if ($idnatx<>"") $sql.=" and a.idnat='".$idnatx."'";

$sql.=" order by a.id desc ";
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";

		$tipob=1; // permite buscar por tipo

		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idactivo=".$_REQUEST['idactivo']."&idnatx=".$_REQUEST['idnatx']."&idactivox=".$_REQUEST['idactivox']."&idpubcorreox=".$_REQUEST['idpubcorreox'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	$rutaPaginacion.="&idtipob=$idtipob";

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
		$dsrutaPapelera="papelera.php?idtipoprod=$idtipoprod";//ruta de la papelera

include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
if ($idlanding<>"") {
	$result=$db->Execute($sql);
	if (!$result->EOF) {
		include("producto.landingpage.tabla.php");

	}
	$result->Close();
} else {
//$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
$result = $db->Execute($sql);
	if (!$result->EOF) {

		include("producto.tabla.importacion.php");
		//include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	else{?>
	<table width="50%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1" style="text-align: center;">
		<tr>
			<td>
				<a href="default.producto.php" class="regresar-href">Listar todos los productos</a>
			</td>
		</tr>
	</table>
	<?}
$result->Close();
	//include("producto.ingreso.php");
}
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>