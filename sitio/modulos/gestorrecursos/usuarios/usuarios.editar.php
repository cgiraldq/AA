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
$titulomodulo="Configuraci&oacute;n de usuarios para el sitio";
$tablarelaciones="tblusuariosxtblmodulos";
$tablaorigen="tblmodulos";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblusuarios";


			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$idactivo=$_REQUEST['idactivo'];
			$dstel=$_REQUEST['dstel'];
			$dscorreo=$_REQUEST['dscorreo'];
			$dslogin=$_REQUEST['dslogin'];
			$dsclave=$_REQUEST['dsclave'];
			$idhab=$_REQUEST['idhab'];
			$idhab2=$_REQUEST['idhab2'];
			if ($dsclave<>"") {
				$clavee = $rc4->encrypt($s3m1ll4, $dsclave);
				$clave = urlencode($clavee);
			}

			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",idactivo=$idactivo";
					//
					$sql.=",dstel='$dstel'";
					$sql.=",dscorreo='$dscorreo'";
					//
					$sql.=",dslogin='$dslogin'";
					$sql.=",dsclave='$clave'";
					//
					$sql.=" where id=".$idx;
					//echo $sql;
					if ($db->Execute($sql))  {
						$error=0;

						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de usuarios";
						$dsruta="../gestorrecursos/usuarios/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						// relaciones
						include($rutxx."../relaciones/relaciones.operaciones.php");

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
$sql="select a.dsm,a.idactivo";
$sql.=",a.dstel,a.dscorreo";
$sql.=",a.dslogin,a.dsclave";
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
$idactivo=$result->fields[1];
$dstel=$result->fields[2];
$dscorreo=$result->fields[3];
$dslogin=$result->fields[4];
$clave=$result->fields[5];
$dsclave = $rc4->decrypt($s3m1ll4, urldecode($clave));
$idhab=$result->fields[6];
$idhab2=$result->fields[7];
?>
<br>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,dslogin,dsclave";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
</td></tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>"
 <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre de la ayuda";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>



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


<tr valign=top bgcolor="#FFFFFF">
<td>Tel&eacute;fono</td>
<td>
<? $contadorx="dstel_counter";$valorx="30";$formax="u";$campox="dstel";?>
<input type=text name=dstel size=20 maxlength="30" class=text1 onKeyPress="ocultar('capa_dstel')" value="<? echo $dstel?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstel";
$mensaje_capa="Debe ingresar el telefono";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Email de contacto</td>
<td>
<? $contadorx="dscorreo_counter";$valorx="255";$formax="u";$campox="dscorreo";?>
<input type=text name=dscorreo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo')" value="<? echo $dscorreo?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscorreo";
$mensaje_capa="Debe ingresar el email de contacto";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Login o usuario</td>
<td>
<? $contadorx="dslogin_counter";$valorx="50";$formax="u";$campox="dsurl";?>
<input type=text name=dslogin size=10 maxlength="50" class=text1 onKeyPress="ocultar('capa_dslogin')" value="<? echo $dslogin?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dslogin";
$mensaje_capa="Debe ingresar el login o usuario";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Clave</td>
<td>
<? $contadorx="dsclave_counter";$valorx="50";$formax="u";$campox="dsclave";?>
<input type=password name=dsclave size=25 maxlength="50" class=text1 onKeyPress="ocultar('capa_dsclave')" value="<? echo $dsclave?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>> (<? echo $dsclave?>)
<?
$nombre_capa="capa_dsclave";
$mensaje_capa="Debe ingresar la clave";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES.</strong> Asocie que modulos puede acceder este usuario:
<br>
<? include($rutxx."../relaciones/default.php");?>
</td>
</tr>


<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,dslogin,dsclave";
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