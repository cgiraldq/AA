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
$tabla="tbldepartamentosmovil";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Contfiguraci&oacute;n de departamentos";
 $dsm=$_REQUEST['dsm'];
 $idpos=$_REQUEST['idpos'];
 $idactivo=$_REQUEST['idactivo'];
 // eliminacion
include($rutxx."../../incluidos_modulos/modulos.papelera.php");
if ($dsm<>"" && $idpos<>"") {

		$sql="select id";
	 	$sql.=" from $tabla WHERE dsm='$dsm' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;
		 }else {
		 	// insertar

			$sql="insert into $tabla (dsm,idpos,idactivo)";
			$sql.=" values ('$dsm',$idpos,$idactivo) ";
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
				$error=0;
			}
		 }
		 $result->close();
}

// actualizar datos
$contarx=count($_REQUEST['id_']);
		$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){

					$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					$sql.= ",dsruta='".limpieza(strtolower($_REQUEST['dsm_'][$j]))."'";
					$sql.= ",idpos='".$_REQUEST['idpos_'][$j]."'";
					$sql.= " where id='".$_REQUEST['id_'][$j]."';";
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for

	if ($h>0) $mensajes=$men[4];
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");
		?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
		 include($rutxx."../../incluidos_modulos/core.mensajes.php");

$sql="select a.id,a.dsm,a.idpos,a.idactivo from ";
$sql.="  $tabla a WHERE a. idactivo not in(9) ";
			if ($letra<>"") $sql.=" and a.".$_REQUEST['campoletra']." like '$letra%'";
			//if ($idactivox<>"") $sql.=" and a.idactivo=$idactivox ";
			if ($_REQUEST['param']<>"") $sql.=" and a.".$_REQUEST['campo']." like '%".$_REQUEST['param']."%'";
			if ($orderby<>"") {
				$sql.=" order by a.$orderby asc ";
			} else {
				$sql.=" order by a.id asc ";
			}
				$rutaPaginacion="param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&letra=".$_REQUEST['letra'];
				$rutaPaginacion.="&idcliente=$idcliente&dscliente=$dscliente&idprograma=$idprograma&dsprograma=$dsprograma&orderby=$orderby&idactivox=$idactivox";
				include($rutxx."../../incluidos_modulos/paginar.variables.php");
				$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
				$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=1;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

				include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
			$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

		include("tabla.php");
		include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
$result->Close();

		include("ingreso.php");

		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>