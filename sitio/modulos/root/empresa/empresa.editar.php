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

$rc4 = new rc4crypt();
$titulomodulo="Configuraci&oacute;n de la empresa autorizada";
$rr="empresa/empresa.php"; // hacia donde regresa
$idx=$_REQUEST['idx'];
$tabla="tblempresa";
$rutaImagen=$rutxx."../../../contenidos/images/empresa/";

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
			$dsnit=$_REQUEST['dsnit'];
			$dstel1=$_REQUEST['dstel1'];
			$dsdir1=$_REQUEST['dsdir1'];
			$dscorreo1=$_REQUEST['dscorreo1'];
			$dscorreo2=$_REQUEST['dscorreo2'];
			$dscorreo3=$_REQUEST['dscorreo3'];
			$dscorreo4=$_REQUEST['dscorreo4'];
			$dstitulo=$_REQUEST['dstitulo'];
			$dsdesc=$_REQUEST['dsdesc'];
			$dskeyw=$_REQUEST['dskeyw'];
			$dsweb=$_REQUEST['dsweb'];
			$dsclave=$_REQUEST['dsclave'];
			$dslogin=$_REQUEST['dslogin'];
			$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
			$clave = urlencode($clavee);
			//datos remitente
			$dsterminos=$_REQUEST['dsterminos'];
			$idtiempo=$_REQUEST['idtiempo'];
			$idformaenvio=$_REQUEST['idformaenvio'];
			$dsnombrerem=$_REQUEST['dsnombrerem'];
			$dscorreorem=$_REQUEST['dscorreorem'];
			$dssmtp=$_REQUEST['dssmtp'];
			$dsusuariocorreo=$_REQUEST['dsusuariocorreo'];
			$dspuerto=$_REQUEST['dspuerto'];
			$dsclavecorreo=$_REQUEST['dsclavecorreo'];
			$dsvalorminimo=$_REQUEST['dsvalorminimo'];
			$codcliente=$_REQUEST['codcliente'];



			$clavecorreoo=$rc4->encrypt($s3m1ll4, $dsclavecorreo);
			$clavecorreo=urlencode($clavecorreoo);

			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsnombre='$dsnombre'";
					$sql.=",dsnit='$dsnit'";
					$sql.=",dstel1='$dstel1'";
					$sql.=",dsimg1='$nombre1'";
					$sql.=",dsdir1='$dsdir1'";
					$sql.=",dscorreo1='$dscorreo1'";
					$sql.=",dscorreo2='$dscorreo2'";
					$sql.=",dscorreo3='$dscorreo3'";
					$sql.=",dscorreo4='$dscorreo4'";
					$sql.=",dstitulo='$dstitulo'";
					$sql.=",dsdesc='$dsdesc'";
					$sql.=",dskeyw='$dskeyw'";
					$sql.=",dsweb='$dsweb'";
					$sql.=",dslogin='$dslogin'";
					$sql.=",dsclave='$clave'";
					$sql.=",dsnombrerem='$dsnombrerem'";
					$sql.=",dscorreorem='$dscorreorem'";
					$sql.=",dssmtp='$dssmtp'";
					$sql.=",dsusuariocorreo='$dsusuariocorreo'";
					$sql.=",dsclavecorreo='$clavecorreo'";
					$sql.=",dspuerto='$dspuerto'";
					$sql.=",dsvalorminimo='$dsvalorminimo'";
					$sql.=",idformaenvio=$idformaenvio";

					//$sql.=",codcliente='$codcliente'";


					$sql.=" where id=".$idx;
					//echo $sql;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						$error=0;
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de destacado index";
						$dsruta="../root/empresa/empresa.php";
						include($rutxx."../../incluidos_modulos/logs.php");
								//
						include($rutxx."../relaciones/relaciones.operaciones.empresa.php");

					}	else {
						$mensajes=$men[7];
						$error=1;
					}

			}



?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsnombre,a.dsnit,a.dstel1,a.dsdir1,a.dscorreo1";
$sql.=",a.dscorreo2,a.dscorreo3,a.dscorreo4,a.dsimg1,a.dstitulo,a.dsdesc,a.dskeyw,a.dsweb";
$sql.=",a.dslogin,a.dsclave,idformaenvio,dsnombrerem,dscorreorem,dssmtp,dsusuariocorreo,dsclavecorreo,dspuerto,idformaenvio,a.dsvalorminimo";
$sql.=",a.codcliente";
$sql.=",a.dsstat";

$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";


$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
if ($_SESSION['i_idperfil']=="-1") {
	$rutamodulo="<a href=' $rutxx../root/default.php' class='textlink'>Principal</a>  /";
	$rr="../empresa/empresa.php"; // hacia donde regresa
} else {
	$rutamodulo="<a href='$rutxx../core/default.php' class='textlink'>Principal</a>  /";
	$rr="../empresa/empresa.php"; // hacia donde regresa
}
$rutamodulo.=" <span class='text1'><a href='../empresa/empresa.php' class='textlink'>".$titulomodulo."</a> / Editar empresa</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsnombre=$result->fields[0];
$dsnit=$result->fields[1];
$dstel1=$result->fields[2];
$dsdir1=$result->fields[3];
$dscorreo1=$result->fields[4];
$dscorreo2=$result->fields[5];
$dscorreo3=$result->fields[6];
$dscorreo4=$result->fields[7];
$dsimg1=$result->fields[8];
$dstitulo=$result->fields[9];
$dsdesc=$result->fields[10];
$dskeyw=$result->fields[11];
$dsweb=$result->fields[12];
$dslogin=$result->fields[13];
$clave=$result->fields[14];
$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));
$idformaenvio=$result->fields[15];
$dsnombrerem=$result->fields[16];
$dscorreorem=$result->fields[17];
$dssmtp=$result->fields[18];
$dsusuariocorreo=$result->fields[19];
$clavecorreo=$result->fields[20];
$dsclavecorreo=$rc4->decrypt($s3m1ll4, urldecode($clavecorreo));
$dspuerto=$result->fields[21];
$dsvalorminimo=$result->fields[23];
$codcliente=$result->fields[24];
$dsstat=$result->fields[25];

?>
<br>

	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr><td align="center" colspan="2">

<?
$forma="u";
$param="dsnombre,dsnit,dstel1,dsdir1,dscorreo1,dstitulo,dsdesc,dskeyw,dsweb,dslogin,dsclave";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
</td></tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td><input type=text name=dsnombre size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnombre')" value="<? echo $dsnombre?>">
<?
$nombre_capa="capa_dsnombre";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>NIT</td>
<td><input type=text name=dsnit size=20 maxlength="20" class=text1 onKeyPress="ocultar('capa_dsnit')" value="<? echo $dsnit?>">
<?
$nombre_capa="capa_dsnit";
$mensaje_capa="Digite el nit";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Tel&eacute;fono</td>
<td><input type=text name=dstel1 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstel1')" value="<? echo $dstel1?>">
<?
$nombre_capa="capa_dstel1";
$mensaje_capa="digite el telefono";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Direcci&oacute;n</td>
<td><input type=text name=dsdir1 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsdir1')" value="<? echo $dsdir1?>">
<?
$nombre_capa="capa_dsdir1";
$mensaje_capa="Digite la direccion";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 1</td>
<td><input type=text name=dscorreo1 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo1')" value="<? echo $dscorreo1?>">
<?
$nombre_capa="capa_dscorreo1";
$mensaje_capa="Digite el correo electr&oacute;nico 1";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>


</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 2</td>
<td><input type=text name=dscorreo2 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo2')" value="<? echo $dscorreo2?>">
<?
$nombre_capa="capa_dscorreo2";
$mensaje_capa="Digite el correo electr&oacute;nico 2";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 3</td>
<td><input type=text name=dscorreo3 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo3')" value="<? echo $dscorreo3?>">
<?
$nombre_capa="capa_dscorreo3";
$mensaje_capa="Digite el correo electr&oacute;nico 3";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Correo electr&oacute;nico 4</td>
<td><input type=text name=dscorreo4 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo4')" value="<? echo $dscorreo4?>">
<?
$nombre_capa="capa_dscorreo4";
$mensaje_capa="Digite el correo electr&oacute;nico 4";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Valor minimo compra cliente. Si coloca 0 no tendra minimo de compra</td>
<td>
<? $contadorx="dsvalorminimo_counter";$valorx="20";$campox="dsvalorminimo";?>
<input type=text name=dsvalorminimo size=20 maxlength="20" class=text1 onKeyPress="ocultar('capa_dsvalorminimo')" value="<? echo $dsvalorminimo?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsvalorminimo";
$mensaje_capa="Debe ingresar el valor minimo de compra distribuidor";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Cargar Logo de la empresa</td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Seleccione y carge la imagen 1";
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
<td>T&iacute;tulo General del sitio</td>
<td><input type=text name=dstitulo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstitulo')" value="<? echo $dstitulo?>">

<?
$nombre_capa="capa_dstitulo";
$mensaje_capa="Digite el t&iacute;tulo del sitio";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n del sitio</td>
<td><textarea name=dsdesc cols=50  rows="5" class=text1 onKeyPress="ocultar('capa_dsdesc')"><? echo $dsdesc?></textarea>
<?
$nombre_capa="capa_dsdesc";
$mensaje_capa="Digite la descripci&oacute;n del sitio";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Palabras claves del sitio</td>
<td><textarea name=dskeyw cols=50  rows="5" class=text1 onKeyPress="ocultar('capa_dskeyw')"><? echo $dskeyw?></textarea>
<?
$nombre_capa="capa_dskeyw";
$mensaje_capa="Debe ingresar las palabras claves del sitio";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<!-- ///////////////////////////subir txt/////////////////////////////////////// -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Cargar archivo txt con el codigo para estadisticas. Siempre debe subirlo en forma de archivo</td>
<td><input type=file name=dsimg3 class=text1 onKeyPress="ocultar('capa_dsimg3')" onClick="ocultar('capa_dsimg3')">
<?
$nombre_capa="capa_dsimg3";
$mensaje_capa="Seleccione y cargue el archivo ";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior3" value="<? echo $dsgoogle?>">
<? if (is_file($rutaImagen.$dsgoogle)) {?>
&nbsp;<a href="<? echo $rutaImagen.$dsgoogle;?>" target="_blank">Descargar Archivo</a>
<br>
<input type="checkbox" name="borrar3" value="1"> Borrar Esta imagen
<input type="hidden" name="img3" value="<? echo $dsgoogle?>">
<br>
Contenido Encontrado en el archivo cargado:
<br>
<textarea name="dslectorestats" cols=60 rows=8>
<?

$file = fopen($rutaImagen.$dsgoogle, "r");
while(!feof($file))
{
echo fgets($file)."";
}
fclose($file);
} ?>
</textarea>
</td>
</tr-->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Codigo Google Analitycs para estadisticas</td>
<td><input type=text name=dsstat size=15 maxlength="30" class=text1 onKeyPress="ocultar('capa_dsstat')" value="<? echo $dsstat?>">
<?
$nombre_capa="capa_dsstat";
$mensaje_capa="Debe ingresar el codigi";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr-->




<tr valign=top bgcolor="#FFFFFF">
<td>Direcci&oacute;n de internet del sitio</td>
<td><input type=text name=dsweb size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsweb')" value="<? echo $dsweb?>">
<?
$nombre_capa="capa_dsweb";
$mensaje_capa="Debe ingresar la direcci&oacute;n de internet";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Login</td>
<td><input type=text name=dslogin size=10 maxlength="50" class=text1 onKeyPress="ocultar('capa_dslogin')" value="<? echo $dslogin?>">
<?
$nombre_capa="capa_dslogin";
$mensaje_capa="Digite el login de acceso central para el cliente";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Clave</td>
<td><input type=password name=dsclave size=15 maxlength="200" class=text1 onKeyPress="ocultar('capa_dsclave')" value="<? echo $dsclave?>"><? echo $dsclave?>
<?
$nombre_capa="capa_dsclave";
$mensaje_capa="Digite la clave de acceso del login";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>

<div id="capa_dsclave" style="display:none"><strong>Digite la clave de acceso</strong></div>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2" align="left"><b>Configuración del correo remitente desde donde se envian los datos de los formularios del sitio</b></td>
</tr>
<?
if($idformaenvio==1)$display="none";
else $display="";
?>
<tr valign=top bgcolor="#FFFFFF">
<td>Seleccione m&eacute;todo de envio</td>
<td>
<select name="idformaenvio" class=text1 onchange="formaenvio()">
<option value="1" <? if($idformaenvio==1)echo 'selected'?>>Mail</option>
<option value="2" <? if($idformaenvio==2)echo 'selected'?>>PHP mailer</option>
</select>
</td>


<tr valign=top bgcolor="#FFFFFF">
<td>Digite el nombre del Remitente</td>
<td><input type=text name=dsnombrerem size=50 maxlength="50" class=text1 onKeyPress="ocultar('capa_dsnombrerem')" value="<? echo $dsnombrerem?>">
<?
$nombre_capa="capa_dsnombrerem";
$mensaje_capa="Digite el login de acceso central para el cliente";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Digite el correo del Remitente</td>
<td><input type=text name=dscorreorem size=50 maxlength="50" class=text1 onKeyPress="ocultar('capa_dscorreorem')" value="<? echo $dscorreorem?>">
<?
$nombre_capa="capa_dscorreorem";
$mensaje_capa="Digite el login de acceso central para el cliente";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo2" style="display:<? echo $display?>">
<td>Digite el Servidor SMTP</td>
<td><input type=text name=dssmtp size=50 maxlength="50" class=text1 onKeyPress="ocultar('capa_dssmtp')" value="<? echo $dssmtp?>">
<?
$nombre_capa="capa_dssmtp";
$mensaje_capa="Digite el login de acceso central para el cliente";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo4" style="display:<? echo $display?>">
<td>Digite login o usuario de acceso al correo</td>
<td><input type=text name=dsusuariocorreo size=50 maxlength="50" class=text1 onKeyPress="ocultar('capa_dsusuariocorreo')" value="<? echo $dsusuariocorreo?>">
<?
$nombre_capa="capa_dsusuariocorreo";
$mensaje_capa="Digite el login de acceso central para el cliente";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF" id="correo1" style="display:<? echo $display?>">
<td>Digite la clave de acceso al correo</td>
<td><input type=text name=dsclavecorreo size=50 maxlength="50" class=text1 onKeyPress="ocultar('capa_dsclavecorreo')" value="<? echo $dsclavecorreo?>">
<?
$nombre_capa="capa_dsclavecorreo";
$mensaje_capa="Digite la clave del correo";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF" id="correo3" style="display:<? echo $display?>">
<td>Digite el puerto de acceso</td>
<td><input type=text name=dspuerto size=50 maxlength="50" class=text1 onKeyPress="ocultar('capa_dspuerto')" value="<? echo $dspuerto?>">
<?
$nombre_capa="capa_dspuerto";
$mensaje_capa="Digite el login de acceso central para el cliente";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr><td align="center" colspan="2">

<?
$forma="u";
$param="dsnombre,dsnit,dstel1,dsdir1,dscorreo1,dstitulo,dsdesc,dskeyw,dsweb,dslogin,dsclave";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type=button name=enviar value="Probar Conexion"  class="botones" onclick="probarconexion()" id="correo5" style="display:<? echo $display?>">
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
<script>
 function formaenvio(){
  if(document.u.idformaenvio.value==2){
   document.getElementById("correo1").style.display="";
   document.getElementById("correo2").style.display="";
   document.getElementById("correo3").style.display="";
   document.getElementById("correo4").style.display="";
   document.getElementById("correo5").style.display="";
  }else{
   document.getElementById("correo1").style.display="none";
   document.getElementById("correo2").style.display="none";
   document.getElementById("correo3").style.display="none";
   document.getElementById("correo4").style.display="none";
   document.getElementById("correo5").style.display="none";
  }
 }

 function probarconexion(){
  var nombrerem=document.u.dsnombrerem.value;
  var correorem=document.u.dscorreorem.value;
  var smtp=document.u.dssmtp.value;
  var usuariorem=document.u.dsusuariocorreo.value;
  var claverem=document.u.dsclavecorreo.value;
  var puerto=document.u.dspuerto.value;

   irAPaginaDN('pconexion.php?nombcorreo='+nombrerem+'&correo='+correorem+'&smtp='+smtp+'&usuario='+usuariorem+'&clave='+claverem+'&puerto='+puerto);


  document.probarcon.submit();

 }
</script>


