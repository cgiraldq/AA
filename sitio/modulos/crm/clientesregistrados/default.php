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
$rc4 = new rc4crypt();


$titulomodulo="Listado de clientes registrados";
$letra=$_REQUEST['letra'];
$enca=$_REQUEST['enca'];
$idclientepago=$_REQUEST['idclientepago'];
$idtiendax=$_REQUEST['idtiendax'];
$idconcursox=$_REQUEST['idconcursox'];
$tabla="tblclientes";
//$db->debug=true;
foreach($_POST as $nombre_campo => $valor){ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
//    echo($nombre_campo.'='.$valor.'<br>'); 

}


if($dsidentificacion<>"" && $dsnombres<>"" && $dsclave<>""){
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsidentificacion='$dsidentificacion' and dscorreocliente='$dscorreocliente' ";
	 	//echo $sql;
		$result = $db->Execute($sql);
		if (!$result->EOF) {
			$mensajes=$men[0];
		 } else { 
		 	$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
			$dsclave = urlencode($clavee);
		 	// insertar
			$sql="insert into $tabla (dsnombres,dsapellidos,dsidentificacion,dscorreocliente,";
		    $sql.="dstelefono,dstelefono2,dsmovil,dsdireccion,dsciudad";
		    $sql.=",idactivo,idtipocliente,dstipoidentificacion,dsfax,dspais,dsdepartamento";
		    $sql.=",dsempresa,dscargo,dsfechanacimiento,dsfecha,dsacepto,idtienda,dsfacebook,dstwitter,dsclave";
			$sql.=" ) values ('$dsnombres','$dsapellidos','$dsidentificacion','$dscorreocliente',";
		    $sql.="'$dstelefono','$dstelefono2','$dsmovil','$dsdireccion','$dsciudad'";
		    $sql.=",'$idactivo',1,'$dstipoid','$dsfax','$dspais','$dsdepartamento'";
		    $sql.=",'$dsempresa','$dscargo','$dsfechanacimiento','".date('Y/m/d-H:m')."','$dsacepta','$idtienda','$dsfacebook','$dstwitter','$dsclave')";
			//echo $sql;
			//exit();
			if ($db->Execute($sql))  { 
				$error=0;
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo cliente ";
				$dsruta="../crm/banners/default.php";
				include("../../../incluidos_modulos/logs.php");
			} else { 
				$error=0;
				$mensajes=$men[2].".<br><br>$sql";
			}	
		 }
		 $result->close();


}


		$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update $tabla set ";
					$sql.=",dsnombres='".$_REQUEST['dsnombres_'][$j]."',dsapellidos='".$_REQUEST['dsapellidos_'][$j]."'";
					$sql.=",dstelefono='".$_REQUEST['dstelefono_'][$j]."',dstelefono2='".$_REQUEST['dstelefono2_'][$j]."'";
					$sql.=",dsdireccion='".$_REQUEST['dsdireccion_'][$j]."',dsmovil='".$_REQUEST['dsmovil_'][$j]."'";
					$sql.=",dsciudad='".$_REQUEST['dsciudad_'][$j]."'";
					$sql.=",dscorreocliente='".$_REQUEST['dscorreocliente_'][$j]."'";
					$sql.= " where id=".$_REQUEST['id_'][$j];
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
		include($rutxx."../../incluidos_modulos/logs.php");

	}
}
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dscodigousa,a.dscodigouk,a.dsnombres,a.dsapellidos";
$sql.=",a.dstelefono,a.dstelefono2,a.dsdireccion,a.dsmovil,a.dsciudad,a.dsdepartamento,a.dspais,a.dscorreocliente";
$sql.=",dstipoidentificacion,a.dsidentificacion,a.dsfechanacimiento,a.dsfecha,a.dsclave,a.idtienda,a.idtiporegistro,a.dsfecharegistro,a.idactivo ";
$sql.=" from $tabla a where id>0 ";
if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
if ($_REQUEST['param']<>"")  {
	if ($_REQUEST['campo']=="dsnombres")  {

	$sql.=" and (a.dsnombres like '%".$_REQUEST['param']."%' or a.dsapellidos like '%".$_REQUEST['param']."%')";	
	} else { 
	$sql.=" and a.".$_REQUEST['campo']." like '".$_REQUEST['param']."%'";	
	
	}
}	
if ($idclientepago<>"") $sql.=" and a.id='".$idclientepago."'";
if ($idtiendax<>"") $sql.=" and a.idtienda='".$idtiendax."'";
if ($idconcursox<>"") $sql.=" and a.idtiporegistro='".$idconcursox."'";


$sql.=" order by a.id desc  ";
//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombres";
		// 2. los tipo de busqueda
		$paramb="dsnombres,dscorreocliente,dsciudad,dsidentificacion";
		$paramn="Nombres y/o Apellido,Email,Ciudad,Identificacion";
		$tienda=1;
		if ($idclientepago=="") include($rutxx."../../incluidos_modulos/modulos.buscador.clientes.php");
	// fin modulo buscador
	$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra']."&idtiendax=".$_REQUEST['idtiendax']."&idconcursox=".$_REQUEST['idconcursox'];
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	$exportar=1; // permite exportar la tabla
	$importar=2;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("contacto.tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
		echo "<br>";
	} // fin si
$result->Close();
include("ingresocliente.php");
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>