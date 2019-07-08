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
$dsm=$_REQUEST['dsm'];
$dsalias=$_REQUEST['dsalias'];
if ($dsm=="") $dsalias=$dsm;

$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$tabla="ecommerce_tblsubcategoriasxcategoria";
$orderby=$_REQUEST['orderby'];
$idlanding=$_REQUEST['idlanding'];
$idtipo=$_REQUEST['idtipo'];
$idcategoria=$_REQUEST['idcategoria'];
if ($idtipo=="") $idtipo=1;
$titulomodulo="Configuracion de subcategorias por categoria";
if ($idtipo==2) $titulomodulo="Configuracion de Categoria de Servicios";
$idnat=$_REQUEST['idnat'];
if ($idnat=="") $idnat=1; // nacional
$rutaImagen="../../../../contenidos/images/ecommerce_categoria/";
//$carpeta="categoria";
//$include="include('../../sitio/producto.php')";
// insercion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
if ($dsm<>"" && $idpos<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' and idtipo=$idtipo and idnat=$idnat ";
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
		 	$error=1;
			$mensajes=$men[0];
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsm,idpos,idactivo,idnat,idtipo,idcategoria,dsalias,dsruta)";
			$sql.=" values ('$dsm',$idpos,$idactivo,$idnat,$idtipo,$idcategoria,'$dsalias','".limpieza(strtolower($dsalias))."') ";
			if ($db->Execute($sql))  {
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro";
				$dsruta="../subcategoriasxcategoria/default.php";
				include($rutxx."../../incluidos_modulos/logs.php");
			} else {
				$mensajes=$men[2].".<br><br>$sql<br>Error:".mysql_error();
			}
		 }
		 $result->close();
}
// eliminacion

// modificacion rapida

		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsalias='".$_REQUEST['dsalias_'][$j]."'";
					$sql.= ",dsruta='".utf8_encode(limpieza(strtolower($_REQUEST['dsalias_'][$j])))."'";
					$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= ",idnat=".$_REQUEST['idnat_'][$j]."";
					//$sql.= ",idcategoria=".$_REQUEST['idcategoria_'][$j]."";

					$sql.= " where id=".$_REQUEST['id_'][$j];
	//				echo $sql."<br>";
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
	
if ($_REQUEST['idx_']<>"") {
		$sql="delete  from tbllanding_page_productos where idlanding=$idlanding and idtipo=2";
		$db->Execute($sql);
		$contarx=count($_REQUEST['idx_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['idx_'][$j]<>"" && $_REQUEST['idactivox_'][$j]<>""){
					$sql=" insert into  tbllanding_page_productos ";
					$sql.= " (idlanding,idprodcat,idtipo,idactivo)";
					$sql.=" values ";
					$sql.= " ($idlanding,".$_REQUEST['idx_'][$j].",2,".$_REQUEST['idactivox_'][$j].")";
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
}

		if ($h>0) $mensajes=$men[4];

?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dsimg1,a.idnat,a.idcategoria,a.dsalias from $tabla a where id>0 and idactivo<>9 and idtipo=$idtipo";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($orderby<>"") {
	$sql.=" order by a.$orderby asc ";
} else {
	$sql.=" order by a.idpos asc ";
}

	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsm";
		// 2. los tipo de busqueda
		$paramb="dsm";
		$paramn="Nombre";
		include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtipo=".$_REQUEST['idtipo'];
	$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma";
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../productos/default.php' class='textlink' title='Principal'>Administracion de Productos</a>  /  ";
	if ($idtipo==2) 	$rutamodulo="<a href='../servicios/default.php' class='textlink' title='Principal'>Administracion de Servicios</a>  /  ";



	if ($idlanding<>"") {
		$rutamodulo.="<a href='../landingpage/default.php' class='textlink' title='Principal'>Landing Page</a>  /  ";
		$rutamodulo.=" <span class='text1'>Asociando Productos</span> /";

		}

		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
		$papelera=1;
		$dsrutaPapelera="papelera.php?idtipo=$idtipo";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
if ($idlanding<>"") {
	$result=$db->Execute($sql);
	if (!$result->EOF) {
		include("categoria.landingpage.tabla.php");

	}
	$result->Close();
} else {
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		include("categoria.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();
	include("categoria.ingreso.php");
	}
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>