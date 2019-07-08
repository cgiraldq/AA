<?
/*
| ----------------------------------------------------------------- |
Sender version 3.5
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.net>
  Juan Felipe S�nchez <graficoweb@comprandofacil.net>
  Jos� Fernando Pe�a <soporteweb@comprandofacil.net>
=====================================================================
| ----------------------------------------------------------------- |
 Modificando Contenido Seleccionado.
*/






$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

////////////////////////////////////////

$sqlxx="select idactivocat,idactivoing from blogtbladmin";
		$resultxx=$db->Execute($sqlxx);
		if(!$resultxx->EOF){
			$activado=$resultxx->fields["0"];
			$activadoing=$resultxx->fields["1"];
		}
		$resultxx->Close();
//////////////////////////////////////



$titulomodulo="Configuracion de Blogs";
$tabla="blogtblblog";
$rutaImagen=$rutxx."../../../contenidos/images/blog/";
$rr="default.php";

$idx=$_REQUEST['idx'];

$dir=$_REQUEST['dir'];
if ($dir==""){
	 $dir=$_REQUEST['dir'];
}
$idcampo=$_REQUEST['idcampo'];
if ($idcampo==""){
	$idcampo=$_REQUEST['idcampo'];
}

$idempresa=$_REQUEST['idempresa'];
if ($idempresa==""){
	$idempresa=$_REQUEST['idempresa'];
}

$dsnombre=$_REQUEST['dsnombre'];
if ($dsnombre==""){
	$dsnombre=$_REQUEST['dsnombre'];
}


$dsvideo=$_REQUEST['dsvideo'];
if ($dsvideo==""){
	$dsvideo=$_REQUEST['dsvideo'];
}


			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");




			$nombre="dsimg2";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");




if ($_REQUEST['inn']==1){

	// variables de carga
	 $campo0=$_REQUEST['campo0']; // nombre
	 $campo1=$_REQUEST['Cuerpo']; // contenido general
	  $Cuerpoingles=$_REQUEST['Cuerpoingles']; // contenido general
	  $dsmingles=$_REQUEST['dsmingles']; // contenido general
	 $dsd2=$_REQUEST['dsd2']; // contenido general
	 $dskw=$_REQUEST['dskw'];
	 $dsdingles=$_REQUEST['dsdingles'];
	 $dsvideo=$_REQUEST['dsvideo'];


    //  $campo1 = str_replace("'","",$campo1);
     // $campo1 = str_replace("á","&aacute;",$campo1);
	// $campo1=str_replace("../","http://localhost:8080/blog_holasa/",$campo1);
	 $idcategoria=$_REQUEST['idcategoria']; // empresa
	 $idautor=$_REQUEST['idautor']; //autores

	$campo2=$_REQUEST['campo2']; // empresa
	$campo3=$_REQUEST['campo3']; // campo
	$idlec=$_REQUEST['idlec']; // campo de habilitar / deshabilitar datos
	$dsfechain=$_REQUEST['dsfechain'];
	if ($idlec==""){
		$idlec=2;
	}



	// fin variables de carga
}
	// insertando
	
	$inn=$_REQUEST['inn'];
	if ($inn==1 && $campo0<>""){
		//actualizando
			$dsruta=limpieza(strtolower($campo0));

			$strSQL="update ".$tabla;
			$strSQL.="  set ";
			$strSQL.=" dsd='$campo1',dsm='$campo0'";
			$strSQL.=" ,dsdlargoingles='$Cuerpoingles'";

			$strSQL.=" ,dsruta='".$dsruta."'";

			if($dsmingles<>""){
				$dsrutaingles=limpieza(strtolower($dsmingles));
			$strSQL.=" ,dsrutaingles='".$dsrutaingles."'";
			}

			$strSQL.=" ,dsd2='$dsd2'";
			$strSQL.=" ,dsmingles='$dsmingles'";
			$strSQL.=" ,dskw='$dskw'";
			$strSQL.=" ,dsdingles='$dsdingles'";

			$strSQL.=" ,idactivo=$campo3";
			$strSQL.=" ,dsfechain='$dsfechain'";
			$strSQL.=",idfechain='".preg_replace("/\//","",$dsfechain)."'";
			$strSQL.=",idcategoria='$idcategoria'";
			$strSQL.=",dsimg='".$imgvec[0]."'";
			$strSQL.=",dsimg2='".$imgvec[1]."'";
			$strSQL.=",idautor='".$idautor."'";
			$strSQL.=",dsvideo='".$dsvideo."'";


			$strSQL.=" where id=".$idx;
			//echo $strSQL;
					if ($db->Execute($strSQL))  {
						$mensajes=$men[6];
						$error=0;
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de blog";
						$dsruta="../blog/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");

					}	else {
						$mensajes=$men[7];
						$error=1;
					}

			// adicional.
			// borrar las listas
			$val=1;
	} elseif ($_REQUEST['inn']==1 && $campo0=="" && $campo1=="") {
			$mensajes=$men[7];
			$error=1;
	}

//}
// Mensajes de resultado
// cargando datos
$sql="select a.id,a.dsm,a.dsd,a.idactivo,a.dsimg,a.dsimg2,a.idcategoria,a.dsruta,a.dsfechain,a.dsd2,a.idautor,a.dsmingles,a.dsdingles,a.dsdlargoingles,dsvideo from ".$tabla." a where id=".$idx;

//echo $strSQL;
$result = $db->Execute($sql);
if (!$result->EOF) {
	$idblog=$result->fields[0];

$campov0=$result->fields[1];
$Cuerpo=$result->fields[2];
$campov3=$result->fields[3];
$dsimg=$result->fields[4];
$dsimg2x=$result->fields[5];
$idcategoria=$result->fields[6];
$dsruta=$result->fields[7];
$dsfechain=$result->fields[8];
$dsd2=$result->fields[9];
$idautor=$result->fields[10];
$dsmingles=$result->fields[11];
$dsdingles=$result->fields[12];
$Cuerpoingles=$result->fields[13];
$dsvideo=$result->fields[dsvideo];

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");
		include("../../tiny/tinymce.php");?>





<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a> / <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

?>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
		<form action="<? echo $_SERVER["PHP_SELF"];?>" method=post name="Compose" ENCTYPE="multipart/form-data">
<tr><td align="center" colspan="2">

			<?
			$forma="Compose";
			$param="campo0,idautor";
			$activareditor=1; 
			include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
</td></tr>


		<tr valign=top bgcolor="#FFFFFF">
		<td valign=top class="textos" width="200" >
			Titulo
		</td>
		<td valign=top>
			<input type=text name="campo0" class=campos value="<? echo $campov0;?>" maxlength="255" size=40 onKeyPress="ocultar('capa_campo0')" value="<? echo $campo0?>"
			<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_campo0";
			$mensaje_capa="Debe ingresar el titulo";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
		</td>
		</tr>

<? if($idactivoing==1){?>
		<tr valign=top bgcolor="#FFFFFF">
		<td valign=top class="textos" width="200" >
			Titulo en ingles
		</td>
		<td valign=top>
			<input type=text name="dsmingles" class=campos value="<? echo $dsmingles;?>" maxlength="255" size=40 onKeyPress="ocultar('capa_dsmingles')" value="<? echo $dsmingles?>"
			<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
			<?
			$nombre_capa="capa_dsmingles";
			$mensaje_capa="Debe ingresar el titulo";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			include($rutxx."../../incluidos_modulos/control.letras.php");?>
		</td>
		</tr>
<?}?>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen principal<br>160 x 100<br/></td>
<td><input  type=file name=dsimg class=text1 onKeyPress="ocultar('capa_dsimg')" onClick="ocultar('capa_dsimg')">
<?
$nombre_capa="capa_dsimg";
$mensaje_capa="Debe cargar la imagen ";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior" value="<? echo $dsimg?>">
<? if (is_file($rutaImagen.$dsimg)) {?>
&nbsp;<img style="width:300px; " src="<? echo $rutaImagen.$dsimg;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar" value="1"> Borrar Esta imagen
<input type="hidden" name="img" value="<? echo $dsimg?>">
<? } ?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Imagen destacada<br>390 x 245<br/></td>
<td><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2x')" onClick="ocultar('capa_dsimg2x')">
<?
$nombre_capa="capa_dsimg2x";
$mensaje_capa="Debe cargar la imagen ";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior1" value="<? echo $dsimg2x?>">
<? if (is_file($rutaImagen.$dsimg2x)) {?>
&nbsp;<img style="width:340px;" src="<? echo $rutaImagen.$dsimg2x;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar1" value="1"> Borrar Esta imagen
<input type="hidden" name="img1" value="<? echo $dsimg2x?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Video</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="400";$campox="dsvideo";?>
<textarea name=dsvideo cols=1  rows="4" class=text1 onKeyPress="ocultar('capa_dsvideo2')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
<!--
<br>
<a name="imagenes"></a><a href="#imagenes" onclick="abrirV('documentos.php?enca=1')" class="text1">Click para subir imagenes al servidor</a>
-->
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Fecha </td>
<td>
<? $contadorx="dsfechain_counter";$valorx="10";$formax="u";$campox="dsfechain";?>
<input type=text name=dsfechain size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechain')"   value="<? echo $dsfechain?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" src="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechain', this);" language="javaScript">
<?
$nombre_capa="capa_dsfechain";
$mensaje_capa="Debe ingresar la fecha inicial de publicación";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Palabras Claves</td>
<td>
<input type=text name="dskw" class=campos value="<? echo $dskw;?>" maxlength="255" size=80 value="<? echo $dskw?>">
</td>
</tr>





<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n peque&ntilde;a<br> Recuerde imagen grande y videos <br>debe tener 650px de ancho m&aacute;ximo</td>
<td>
<? $contadorx="dsd2_counter";$valorx="400";$campox="dsd2";?>
<textarea name=dsd2 cols=1  rows="4" class=text1 onKeyPress="ocultar('capa_dsd22')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
<!--
<br>
<a name="imagenes"></a><a href="#imagenes" onclick="abrirV('documentos.php?enca=1')" class="text1">Click para subir imagenes al servidor</a>
-->
</td>
</tr>

<? if($idactivoing==1){?>
<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n peque&ntilde;a en ingles<br> Recuerde imagen grande y videos <br>debe tener 650px de ancho m&aacute;ximo</td>
<td>
<? $contadorx="dsd2_counter";
$valorx="400";$campox="dsdingles";?>
<textarea name=dsdingles cols=1  rows="4" class=text1 onKeyPress="ocultar('capa_dsdingles')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsdingles?></textarea>
<?
$nombre_capa="capa_dsdingles";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>
<?}?>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n larga en espa&ntilde;ol</td>
<td>
<? $contadorx="Cuerpo_counter";
$valorx="400";$campox="dsdingles";?>
<textarea name=Cuerpo cols=1  rows="4" class=text1 onKeyPress="ocultar('capa_Cuerpo')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $Cuerpo?></textarea>
<?
$nombre_capa="capa_Cuerpo";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<? if($idactivoing==1){?>
<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n larga en ingl&eacute;s</td>
<td>
<? $contadorx="Cuerpoingles_counter";
$valorx="400";$campox="dsdingles";?>
<textarea name=Cuerpoingles cols=1  rows="4" class=text1 onKeyPress="ocultar('capa_Cuerpoingles')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $Cuerpoingles?></textarea>
<?
$nombre_capa="capa_Cuerpoingles";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>
<?}?>




	<? if($activado==1){?>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textos>
		Categoria
		</td>
		<td valign=top>
			<select name="idcategoria" class=textos onKeyPress="ocultar('capa_idcategoria')" value="<? echo $idcategoria?>"
				<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
				<?
			$sqlx="select id,dsm from blogtblcategorias where idactivo=1";
			//echo $sql;
			$resultx=$db->Execute($sqlx);
			if(!$resultx->EOF){
			?>
			<option value="">Seleccione la categoria</option>
			<?
			while(!$resultx->EOF){
			$idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			?>
				<option value="<? echo $idm?>" <? if ($idm==$idcategoria) echo "selected";?>><? echo ucfirst(strtolower($dsm)); ?></option>
		<?
			$resultx->MoveNext();
			}

			}
			$resultx->Close();
			?>

			</select>
			<?
			$nombre_capa="capa_idcategoria";
			$mensaje_capa="<font color='red'>Debe ingresar la categoria</font>";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			?>
		</td>
		</tr>
<?}?>


			<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textos>
		Autor Asociado
		</td>
		<td valign=top>
			<select name="idautor" class=textos onKeyPress="ocultar('capa_idautor')" value="<? echo $idautor?>" <? include("../../incluidos_modulos/control.evento.php");?>>
				<?
			$sqlx="select id,dsm from blogtblautores where idactivo=1";
			//echo $sql;
			$resultx=$db->Execute($sqlx);
			if(!$resultx->EOF){
			?>
			<option value="">Seleccione el autor</option>
			<?
			while(!$resultx->EOF){
			$idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			?>
				<option value="<? echo $idm?>" <? if ($idm==$idautor) echo "selected";?>><? echo ucfirst(strtolower($dsm)); ?></option>
		<?
			$resultx->MoveNext();
			}

			}
			$resultx->Close();
			?>

			</select>
			<?
			$nombre_capa="capa_idautor";
			$mensaje_capa="<font color='red'>Debe ingresar el autor</font>";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			?>
		</td>
		</tr>


		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=textos>
			Activar
		</td>
		<td valign=top>
			<select name="campo3" class=textos>
		<option value="4" <? if ($campov3==4) echo "selected";?>>SI</option>
		<option value="2" <? if ($campov3==2) echo "selected";?>>NO</option>
		<option value="3" <? if ($campov3==3) echo "selected";?>>DESTACADO PRINCIPAL</option>
			</select>
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[9];?>" align=center>
			<td valign=top colspan=2>
			<? $rutaenvio =$dsruta?>

			<?
			$forma="Compose";
			$param="campo0,idautor";
			$editor=1;
			include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
			<input type="hidden" name="idx" value="<? echo $idx?>">
			<!--input type=button name=enviar value="Vista previa" class="botones"  onclick="irAPaginaD('../../blog.php?rutax=<? echo $rutaenvio?>&idblogx=<? echo $idblog ?>&activo=<? echo $campov3 ?>')" -->
			<input type=hidden name=inn value="1">
			<input type=hidden name=tabla value="<? echo $tabla;?>">
			<input type=hidden name=idcampo value="<? echo $idcampo;?>">
			<input type=hidden name=dir value="<? echo $dir;?>">
			</td>
		</tr>
		</form>

	</table>
<br>


<br>

</td>
</tr>
</table>


<?
} // fin si
$result->Close();
?>

<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
	<script language="JavaScript" type="text/javascript">
	function abrirV(pagina){
	var ruta=pagina;
			window.open(ruta,"",'scrollbars=yes,width=800,height=600,left=50,top=2,resizable=yes');
	}
	</script>
