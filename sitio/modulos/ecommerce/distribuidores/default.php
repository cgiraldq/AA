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
$rutxx="../";

include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();


$titulomodulo="Listado de distribuidores registrados";
$letra=$_REQUEST['letra'];
$enca=$_REQUEST['enca'];
$idclientepago=$_REQUEST['idclientepago'];
$idtiendax=$_REQUEST['idtiendax'];
$idconcursox=$_REQUEST['idconcursox'];


$tabla="tblclientes";
//$db->debug=true;

		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.= "idtipocliente='".$_REQUEST['idtipocliente_'][$j]."'";
					$sql.= ",idactivo='".$_REQUEST['idactivo_'][$j]."'";

					$sql.=",dsnombres='".$_REQUEST['dsnombres_'][$j]."',dsapellidos='".$_REQUEST['dsapellidos_'][$j]."'";
					$sql.=",dstelefono='".$_REQUEST['dstelefono_'][$j]."',dstelefono2='".$_REQUEST['dstelefono2_'][$j]."'";
					$sql.=",dsdireccion='".$_REQUEST['dsdireccion_'][$j]."',dsmovil='".$_REQUEST['dsmovil_'][$j]."'";
					$sql.=",dsciudad='".$_REQUEST['dsciudad_'][$j]."',dsdepartamento='".$_REQUEST['dsdepartamento_'][$j]."'";
					$sql.=",dspais='".$_REQUEST['dspais_'][$j]."',dscorreocliente='".$_REQUEST['dscorreocliente_'][$j]."'";
					$sql.=",dstipoidentificacion='".$_REQUEST['dstipoidentificacion_'][$j]."',dsidentificacion='".$_REQUEST['dsidentificacion_'][$j]."'";
					$sql.=",dsfechanacimiento='".$_REQUEST['dsfechanacimiento_'][$j]."' ";
					$sql.=",dspreciomindistrib='".$_REQUEST['dspreciomindistrib_'][$j]."' ";

					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql."<br>";
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];


// eliminacion



$idx=$_REQUEST['idx'];
if ($idx<>"") {
	$sql=" delete from $tabla WHERE id='$idx' ";
	if ($db->Execute($sql))  {
		$mensajes="<strong>".$men[3]."</strong>";
		$dstitulo="Eliminacion $titulomodulo";
		$dsdesc=" El usuario ".$_SESSION['i_dslogin']." elimino registro de $titulomodulo";
		$dsruta="../clientesregistrados/default.php";
		include("../../incluidos_modulos/logs.php");

	}
}
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.idtipocliente,a.idactivo,a.dsnombres,a.dsapellidos";
$sql.=",a.dstelefono,a.dstelefono2,a.dsdireccion,a.dsmovil,a.dsciudad,a.dsdepartamento,a.dspais,a.dscorreocliente";
$sql.=",dstipoidentificacion,a.dsidentificacion,a.dsfechanacimiento,a.dsfecha,a.dsclave,a.idtienda,a.idtiporegistro,a.dsfecharegistro,a.dspreciomindistrib";
$sql.=" from $tabla a where id>0 and a.idtipocliente=1";
//echo $sql;
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";
if ($idclientepago<>"") $sql.=" and a.id='".$idclientepago."'";
if ($idtiendax<>"") $sql.=" and a.idtienda='".$idtiendax."'";
if ($idconcursox<>"") $sql.=" and a.idtiporegistro='".$idconcursox."'";


$sql.=" order by a.id desc  ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombres";
		// 2. los tipo de busqueda
		$paramb="dsnombres,dsapellidos,dscorreocliente,dsciudad,dsidentificacion";
		$paramn="Nombre,Apellido,Email,Ciudad,Identificacion";
		$tienda=1;
		if ($idclientepago=="") include($rutxx."../../incluidos_modulos/modulos.buscador.clientes.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtiendax=".$_REQUEST['idtiendax']."&idconcursox=".$_REQUEST['idconcursox'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='".$rutxx."../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$exportar=1; // permite exportar la tabla
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("contacto.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
		echo "<br>";
	} // fin si
$result->Close();
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>