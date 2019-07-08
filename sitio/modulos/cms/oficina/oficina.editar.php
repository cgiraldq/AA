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

$titulomodulo="Configuraci&oacute;n de oficinas";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tbloficina";
$rutaImagen=$rutxx."../../../contenidos/images/oficina/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/oficina/";
$carpeta="eventos";//ubicadion de los archivos para rutas amigables
$rutaPlayer="../"; // uso desde el admon

			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


			$nombre="dsimg3";
			$nombreant="archivoanterior3";
			$borrar=$_REQUEST['borrar3'];
			$valimg=$_REQUEST['img3'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dscorreo=$_REQUEST['dscorreo'];
			$dstelefono=$_REQUEST['dstelefono'];
			$dsdireccion=$_REQUEST['dsdireccion'];
			$idciudad=$_REQUEST['idciudad'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsruta='".limpieza(strtolower($_REQUEST['dsm']))."'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsimg2='".$imgvec[1]."'";
					$sql.=",dscorreo='$dscorreo'";
					$sql.=",dstelefono='$dstelefono'";
					$sql.=",dsdireccion='$dsdireccion'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=",idc=$idciudad";
					$sql.=" where id=".$idx;
					//echo $sql;

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/oficina/default.php";

						include($rutxx."../../incluidos_modulos/logs.php");

					}	else {
						$mensajes=$men[7];
					}
			}



?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsd,a.dsimg,a.dscorreo,a.dstelefono,a.dsdireccion,a.dsimg2,a.idc";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsd=$result->fields[3];
$dsimg1=$result->fields[4];
$dscorreo=$result->fields[5];
$dstelefono=$result->fields[6];
$dsdireccion=$result->fields[7];
$dsimg3=$result->fields[8];
$idciudad=$result->fields[9];
?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Horario de atencion</td>
<td>
<? $contadorx="dsd_counter";$valorx="200";$campox="dsd";?>
<textarea name=dsd cols=80  rows="3" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n corta";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Imagen <br>215 x 195<br><br/></td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Debe cargar la imagen 1";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior1" value="<? echo $dsimg1?>">
<? if (is_file($rutaImagen.$dsimg1)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg1;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar1" value="1"> Borrar Esta imagen
<input type="hidden" name="img1" value="<? echo $dsimg1?>">
<? } ?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Direccion</td>
<td>
<? $contadorx="dsdireccion_counter";$valorx="200";$formax="u";$campox="dsdireccion";?>
<input type=text name=dsdireccion size=30 maxlength="200" class=text1 onKeyPress="ocultar('capa_dsdireccion')" value="<? echo $dsdireccion?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsdireccion";
$mensaje_capa="Debe ingresar la direccion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Correo</td>
<td>
<? $contadorx="dscorreo_counter";$valorx="100";$formax="u";$campox="dscorreo";?>
<input type=text name=dscorreo size=30 maxlength="100" class=text1 onKeyPress="ocultar('capa_dscorreo')" value="<? echo $dscorreo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscorreo";
$mensaje_capa="Debe ingresar el correo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Telefono</td>
<td>
<? $contadorx="dstelefono_counter";$valorx="200";$formax="u";$campox="dstelefono";?>
<input type=text name=dstelefono size=30 maxlength="200" class=text1 onKeyPress="ocultar('capa_dstelefono')" value="<? echo $dstelefono?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstelefono";
$mensaje_capa="Debe ingresar el telefono";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Ciudad</td>
<td>
	<select name=idciudad class=text1>
		 <? categorias('tblciudades',$idciudad)?>
		</select>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td style="width: 85px">Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>Principal</option>
	</select>

</td>
</tr>
<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsm,dsd,idpos";
$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
//$mod=2;
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<a name="video"></a>
<?
} // fin si
$result->Close();
?>
<br>
<? include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>
<script language="javascript">
	function mostrarcalendario(){
		document.getElementById('calendario').style.display="";
		document.getElementById('boton').style.display="";
		document.getElementById('botoncalendario').style.display="none";
		location.href="#calendario";
	}
</script>