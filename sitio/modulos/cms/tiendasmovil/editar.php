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
$injection="no";
$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuracion de Ayuda";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tbltiendas";
$rutaImagen="../../../../contenidos/images/tiendas/";


			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include("../../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dsruta=$_REQUEST['dsruta'];


			$paso=$_REQUEST['paso'];
			if ($paso=="1") {


					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsruta='$dsruta'";
					$sql.=",idpos=$idpos";
					$sql.= ",idciudad=".$_REQUEST['idciudad'];
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;

			//exit;

					if ($db->Execute($sql))  {
						$error=0;
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/tiendas/default.php";
						include("../../../incluidos_modulos/logs.php");
					}	else {
						$mensajes=$men[7];
					}
			}



?>
<html>
<?include("../../../incluidos_modulos/head.php");?>
<body >
<? include("../../../incluidos_modulos/navegador.principal.php");?>
<?
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.idciudad";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsimg=$result->fields[2];
$idpos=$result->fields[3];
$dsruta=$result->fields[4];
$idactivo=$result->fields[5];
$idciudad=$result->fields[6];

?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="../../../img_modulos/modulos/edicion.png">
         		<h1>Edicion del registro seleccionado</h1>
         	</td>
        </tr>
</table>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="dsm,idpos";
	include("../../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Titulo</p></td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include("../../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include("../../../incluidos_modulos/control.capa.php");
include("../../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Descripci&oacute;n</p></td>
<td>
<? $contadorx="dsd_counter";$valorx="3500";$campox="dsd";?>
<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include("../../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include("../../../incluidos_modulos/control.capa.php");
include("../../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Imagen <br>670 x 250</p><br/></td>
<td><input type=file name=dsimg class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg')">
<?
$nombre_capa="capa_dsimg";
$mensaje_capa="Debe cargar la imagen ";
include("../../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior" value="<? echo $dsimg?>">
<? if (is_file($rutaImagen.$dsimg)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar" value="1"> Borrar Esta imagen
<input type="hidden" name="img" value="<? echo $dsimg?>">

<? } ?>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Posici&oacute;n</p></td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="return numero(event);ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
include("../../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td><p>Sitio Ruta </p></td>
<td><input type=text name=dsruta size=1 maxlength="255" class=text1 onKeyPress="return numero(event);ocultar('capa_dsruta')" value="<? echo $dsruta?>">
<?
$nombre_capa="capa_dsruta";
$mensaje_capa="Debe digitar ruta ";
include("../../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Ciudad</p></td>
<td>
		<select name="idciudad" id="idciudad">
		<option value="">--Seleccion--</option>
		<?categorias('tblciudades',$idciudad)?>
		</select>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Activar?</p></td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>DISTRIBUIDORES</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>TIENDAS</option>
	</select>

</td>
</tr>




<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?$forma="u";
	$param="idpos";
	include("../../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>
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
<?	include("../../../incluidos_modulos/navegador.principal.cerrar.php");
	include("../../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
<script language="javascript">
    function mostrarcapa(){
                   var contenedor1=document.getElementById('video2');// se utiliza de esta manera para poder q los botones de solicitar y recomendar funcionen en mozila
                                   contenedor1.style.display = "";
    }
</script>
