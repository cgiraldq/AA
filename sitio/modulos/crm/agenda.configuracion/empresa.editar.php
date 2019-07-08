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
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Configuraci&oacute;n general del CRM";
$rr="default.php"; // hacia donde regresa
$idx=$_REQUEST['idx'];
$tabla="crmtblagendamiento";
$rutaImagen="../../../contenidos/images/empresa/";

			if ($_FILES['dsimg1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior1'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg1']['tmp_name'];
				$nombre1=$tabla.$idx."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre1);
				} elseif ($_REQUEST['img1']<>"") {
				$nombre1=$_REQUEST['img1'];
				}
				if ($_REQUEST['borrar1']==1) $nombre1="";


			$dsnombre=$_REQUEST['dsnombre'];
			$dsrango=$_REQUEST['dsrango'];
			$dsrango2=$_REQUEST['dsrango2'];

			$dshorai=$_REQUEST['dshorai'];
			$dshoraf=$_REQUEST['dshoraf'];
			$idtipoactividad=$_REQUEST['idtipoactividad'];
			$idcompromisos=$_REQUEST['idcompromisos'];
			$idfechaanterior=$_REQUEST['idfechaanterior'];


			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsnombre='$dsnombre'";
					$sql.=",dsrango='$dsrango'";
					$sql.=",dsrango2='$dsrango2'";

					$sql.=",dshorai='$dshorai'";
					$sql.=",dshoraf='$dshoraf'";
					$sql.=",idtipoactividad='$idtipoactividad'";
					$sql.=",idcompromisos='$idcompromisos'";
					$sql.=",idfechaanterior='$idfechaanterior'";


					$sql.=" where idempresa=".$idx;
					//echo $sql;
					if ($db->Execute($sql)) $mensajes=$men[6];
			}

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>

<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include($rutxx."../../incluidos_modulos/navegador.principal.php");// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select dsnombre,dsrango,dshorai,dshoraf,idtipoactividad,dsrango2,idcompromisos,idfechaanterior from $tabla";
$sql.=" where idempresa=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href='default.php' target='_top' class='textlink'>Principal</a>  /";
} else {
	$rutamodulo="<a href='../../core/default.php' target='_top' class='textlink'>Principal</a>  /";
	$rr="../core/default.php"; // hacia donde regresa
}
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsnombre=$result->fields[0];

$dsrango=$result->fields[1];
$dshorai=$result->fields[2];
$dshoraf=$result->fields[3];
$idtipoactividad=$result->fields[4];

$dsrango2=$result->fields[5];
$idcompromisos=$result->fields[6];
$idfechaanterior=$result->fields[7];


?>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td><input type=text name=dsnombre size=30 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnombre')" value="<? echo $dsnombre?>">
<?
$nombre_capa="capa_dsnombre";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td>Rango de tiempo para el agendamiento</td>

	<td>
		<select name="dsrango" class="textnegro2">
				<option value="1" <? if($dsrango==1)echo 'selected'?>  >1 min</option>
				<option value="5" <? if($dsrango==5)echo 'selected'?> >5 min</option>
				<option value="10" <? if($dsrango==10)echo 'selected'?>  >10 min</option>
				<option value="15" <? if($dsrango==15)echo 'selected'?> >15 min</option>
				<option value="20" <? if($dsrango==20)echo 'selected'?> >20 min</option>
				<option value="30" <? if($dsrango==30)echo 'selected'?> >30 min</option>
			</select>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td>Rango de tiempo para mostrar en la agenda</td>

	<td>
		<select name="dsrango2" class="textnegro2">
				<option value="1" <? if($dsrango2==1)echo 'selected'?>  >1 min</option>
				<option value="5" <? if($dsrango2==5)echo 'selected'?> >5 min</option>
				<option value="10" <? if($dsrango2==10)echo 'selected'?>  >10 min</option>
				<option value="15" <? if($dsrango2==15)echo 'selected'?> >15 min</option>
				<option value="20" <? if($dsrango2==20)echo 'selected'?> >20 min</option>
				<option value="30" <? if($dsrango2==30)echo 'selected'?> >30 min</option>
			</select>
	</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
	<td>Hora inicial</td>
	<td>
		<select name="dshorai" class="textnegro2">
				<option value="6" <? if($dshorai==6)echo 'selected'?> >6 am</option>
				<option value="7" <? if($dshorai==7)echo 'selected'?> >7 am</option>
				<option value="8" <? if($dshorai==8)echo 'selected'?> >8 am</option>
		</select>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td>Hora inicial</td>
	<td>
		<select name="dshoraf" class="textnegro2">
				<option value="18" <? if($dshoraf==18)echo 'selected'?> >6 pm</option>
				<option value="19" <? if($dshoraf==19)echo 'selected'?> >7 pm</option>
				<option value="20" <? if($dshoraf==20)echo 'selected'?> >8 pm</option>
				<option value="21" <? if($dshoraf==21)echo 'selected'?> >9 pm</option>
		</select>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td>Seleccionar tipo de actividad</td>
	<td>
		<select name="idtipoactividad" class="textnegro2">
				<option value="0"> --Seleccionar--</option>
				<option value="1" <? if($idtipoactividad==1)echo 'selected'?> >Actividades generales</option>
				<option value="2" <? if($idtipoactividad==2)echo 'selected'?> >Actividades por roles</option>

		</select>
	</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
	<td>Activar Compromisos en la agenda?</td>
	<td>
		<select name="idcompromisos" class="textnegro2">
				<option value="0"> --Seleccionar--</option>
				<option value="1" <? if($idcompromisos==1)echo 'selected'?> >SI</option>
				<option value="2" <? if($idcompromisos==2)echo 'selected'?> >NO</option>

		</select>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td>Permitir agendar o reportar actividades en dias anteriores ?</td>
	<td>
		<select name="idfechaanterior" class="textnegro2">
				<option value="0"> --Seleccionar--</option>
				<option value="1" <? if($idfechaanterior==1)echo 'selected'?> >SI</option>
				<option value="2" <? if($idfechaanterior==2)echo 'selected'?> >NO</option>

		</select>
	</td>
</tr>



<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsnombre";
$rr="empresa.php"; // hacia donde regresa
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>

<?

} // fin si
$result->Close();
?>
<br>
<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
