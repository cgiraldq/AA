<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2013
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseñoframecf_tbltiposformulariosxgalerias
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
//include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Configuraci&oacute;n de Im&aacute;genes para registro seleccionado ";


$dsm=$_REQUEST['dsm'];
$idpos=$_REQUEST['idpos'];
$idactivo=$_REQUEST['idactivo'];
$letra=$_REQUEST['letra'];
$orderby=$_REQUEST['orderby'];
$idactivox=$_REQUEST['idactivox'];

$idy=$_REQUEST['idy'];
$dsy=$_REQUEST['dsy'];

$idx=$_REQUEST['idx'];
$dsz=$_REQUEST['dsz'];

$tabla="framecf_tbltiposformulariosxobservaciones";

// insercion
if ($dsd<>"") {


		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsd='$dsd' and idregistro='$idy' and idtipoformulario='$idx' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;
		 } else {
		 	// insertar
			$sql="insert into $tabla (dsd,dsm,idregistro,idtipoformulario,dsfecha,usuario)";
			$usuario=$_SESSION['i_dsnombre'];
			$sql.=" values ('$dsd','".$_SESSION['i_dslogin']."','$idy','$idx','$fechaBaseLarga','$usuario') ";
			//echo $sql;
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$error=0;
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro de banner";

				include($rutxx."../../incluidos_modulos/logs.php");
			} else {
				$mensajes=$men[2].".<br><br>$sql";
				$error=1;
			}
		 }
		 $result->close();
		 include($rutxx."../../incluidos_modulos/modulos.mensajes.php");
}

// modificacion rapida


				if ($_REQUEST['idxx']<>""){
					$sql=" delete from $tabla ";
					$sql.= " where id=".$_REQUEST['idxx'].";";
					//echo $sql;
					if ($db->Execute($sql)) $error=0;$mensajes=$men[3];
					include($rutxx."../../incluidos_modulos/modulos.mensajes.php");
				} // fin si






// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsd,a.dsm from $tabla a where idactivo not in(9) ";
$sql.=" and idregistro='".$_REQUEST['idy']."'";
$sql.=" and idtipoformulario='".$_REQUEST['idx']."'";
$sql.=" order by a.idpos asc ";

//echo $sql;




$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=2;
				$campocondicion="idregistro";
				$condicion=$idy;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		//include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("formulario.observaciones.tabla.php");
		//include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	$result->Close();
	include("ingreso.observaciones.php");
	?>

