<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
Principal del manejo de la agenda
*/
// include ("../sessiones.php");
$rutx=1;
if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/funciones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
//$db->debug=true;
//include("../../incluidos_modulos/modulos.globales.php");

$formabase="agenda";
//include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
$rutabase="../agenda/default.php"; // para la agenda
?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>


<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	include($rutxx."../../incluidos_modulos/core.mensajes.php");

	$rutamodulo="<a href='../../core/default.php' target='_top' class='textlink'>Principal</a>  /";
	$rutamodulo.="  <span class='text1'>Modulo de agendamiento</span>";
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
?>
<form name="u" id="u" action="default.php" >

	<table  cellspacing="1" cellpadding="1" width="100%" border="0" ID="Table2" class="cont_crm_agendamiento">

		<? 

$sql="select a.id,a.dsm from  tblusuarios a";
if($_SESSION['i_idusuario']<>1) $sql.=", tblusuarioxtblagenda b where a.id=b.iddestino and b.idorigen=".$_SESSION['i_idrol'];
//if($_SESSION['i_idusuario']==1 || $_SESSION['i_idrol_admon']==1) $sql.=" where a.idactivo=1 and idrol=4";
//	echo $_SESSION['i_idrol_admon']."--".$_SESSION['i_idusuario']." -- ".$sql;

			$resultx=$db->Execute($sql);
   		if (!$resultx->EOF) {


		?>
		<tr>

			<td colspan="2">Seleccionar asesor:
				<select name="idusuario" id="idusuario" onchange="Abrir_capa_formulario('idusuario');">
					<option value="<? echo $_SESSION['i_idusuario'] ?>"> -- Seleccionar -- </option>
					<? while (!$resultx->EOF) {
						$id=$resultx->fields[0];
						$dsm=reemplazar($resultx->fields[1]);

					?>
						<option value="<? echo $id;?>" <? if($id==$_REQUEST["idusuario"]) echo "selected";?>><? echo $dsm;?></option>
					<?
						$resultx->MoveNext();
					}?>

				</select>
			</td>
		</tr>

		<?

	}else{
		$mostraragenda=1;
	}
	$resultx->Close();
	?>




		<tr>
			<td width="20%" align="center" valign="top" bgcolor="<? echo $fondos[4];?>">
			<? include ("panel.derecho.php");?>
		</td>

		
			<? if($_REQUEST['Agendamiento']<>"Agendamiento" && ($_REQUEST["idusuario"]<>0 || $_SESSION['i_idusuario']<>"") ){ ?>
			<td width="70%" align="center" valign="top" style="display:" id="calendar">
				<? include ("listado.actividades.php");?>
			</td>
			<?}?>

	
			<td width="70%" align="center" valign="top" id="calendar">
			<? if( ($_REQUEST["idusuario"]<>0 || $_SESSION['i_idusuario']<>"") && $_REQUEST['Agendamiento']=="Agendamiento"){ ?>
				<? include ("panel.izquierdo.php");?>
			<?}?>
			</td>


			</td>
		</tr>

	</table>

</form>

<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>


</body>
</html>

<script type="text/javascript">

function Abrir_capa_formulario(parametro){

	var valor=document.getElementById(parametro).value;
	//	alert(valor);
  		if (document.getElementById(parametro)!=0) {
  				//document.getElementById('calendar').style.display='';
  				document.getElementById("u").submit();
  				document.getElementById("idusuario").value(valor);
  		}
 }

</script>