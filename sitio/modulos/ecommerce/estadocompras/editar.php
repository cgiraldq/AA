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
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Listado de Consejos";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="ecommerce_tblestadoscompra";
$rutaImagen="../../../../contenidos/images/consejos/";

			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg2";
			$nombreant="archivoanterior2";
			$borrar=$_REQUEST['borrar2'];
			$valimg=$_REQUEST['img2'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

					
			$dsm=$_REQUEST['dsm'];
			$dssubt=$_REQUEST['dssubt'];

			$dsd=$_REQUEST['dsd'];
			$dsd2=$_REQUEST['dsd2'];

			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			
			
			$paso=$_REQUEST['paso'];
			if ($paso=="1" && $dsm<>"") { 


					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dssubt='$dssubt'";

					$sql.=",dsd='$dsd'";
					$sql.=",dsd2='$dsd2'";

					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsimg2='".$imgvec[1]."'";

					$sql.=",dsruta='".limpieza(strtolower($dsm))."'";				
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
			//		echo $sql;
					
			//exit;
					
					if ($db->Execute($sql))  { 
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../listadodeconsejos/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");	
					}	else { 
						$error=1;
						$mensajes=$men[7];
					}
			}
			
			

?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dssubt,a.dsd2,a.dsimg2";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsimg=$result->fields[2];
$idpos=$result->fields[3];
$dsruta=$result->fields[4];
$idactivo=$result->fields[5];

$dssubt=$result->fields[6];
$dsd2=$result->fields[7];
$dsimg2=$result->fields[8];

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
	$param="dsm,dsd,idpos";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Titulo</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n</td>
<td>
<? $contadorx="dssubt_counter";$valorx="255";$formax="u";$campox="dssubt";?>
<textarea name=dssubt cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dssubt')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dssubt?></textarea>
<?
$nombre_capa="capa_dssubt";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Asunto Correo</td>
<td>
<? $contadorx="dsd_counter";$valorx="255";$campox="dsd";?>
<input type=text name=dsd cols=80 value="<? echo $dsd?>" rows="8" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Cuerpo Correo</td>
<td>
<? $contadorx="dsd2_counter";$valorx="7500";$campox="dsd2";?>
<textarea name=dsd2 cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd22')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n larga";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="return numero(event);ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
 
?>
</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>		  
	</select>

</td>
</tr>
<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="dsm,dsd,idpos";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
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

	<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>