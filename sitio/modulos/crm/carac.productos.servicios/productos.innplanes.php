<?
/*
| ----------------------------------------------------------------- |
WebCenter Version 2.0
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$tabla=$_REQUEST['tabla'];
if ($tabla==""){
	$tabla=$_REQUEST['tabla'];
}
$dir=$_REQUEST['dir'];
if ($dir==""){
	$dir=$_REQUEST['dir'];
}
if ($_REQUEST['inn']==1){
	// variables de carga
	$campo0=$_REQUEST['campo0']; // nombre
	$campo2=$_REQUEST['campo2']; // activo
	// fin variables de carga
}
$dir=1;
// validaciones de datos
if ($dir==1){
	$mensajeData="Ingresando actividad para producto o servicio";
	// armando vector de campos
	$camposN[0]="Nombre";
	$camposN[2]="Activo?";

	if ($_REQUEST['inn']==1){
		$strSQL=" select dsz from ".$tabla." where dsz='$campo0' and idempresa=".$_SESSION['i_idempresa'];
		$vermas=mysql_db_query($dbase,$strSQL,$db);
		$num=mysql_num_rows($vermas);
		if ($num>=1){
			$val=1;
		} else {
			$strSQL="insert into ".$tabla." (idempresa,dsz,idactivo)";
			$strSQL.="  values (";
			//$strSQL.=" '',".$_SESSION['i_idempresa'].",$campo3,'$campo0','$campo1',";
			$strSQL.=" ".$_SESSION['i_idempresa'].",'$campo0'";

			$strSQL.=",$campo2";
			$strSQL.=" )";
			if (mysql_db_query($dbase,$strSQL,$db)) {
				$val=2;
				$strSQL=" select idz from ".$tabla." where dsz='$campo0' and idempresa=".$_SESSION['i_idempresa'];
				$vermasx=mysql_db_query($dbase,$strSQL,$db);
				if (mysql_num_rows($vermasx)>0) {
					$idcampo=mysql_result($vermasx,"0","idz");
					?>
					<script language="javascript">
					<!--
					location.href="productos.planes.php?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idcampo=<? echo $idcampo;?>";
					//-->
					</script>
					<?
				}
				mysql_free_result($vermasx);
			} else {
				echo mysql_error()."<br>".$strSQL;
			}


		}
		mysql_free_result($vermas);
	}
}


// Mensajes de resultado
if ($val==1) {
	// no iongresa
		$Mensaje="Los Datos no pueden ser ingresados en el sistema para (".$campo0."). Intente de nuevo";
} elseif ($val==2) {
	// ingresa
		$Mensaje="Datos ingresados en el sistema para  (".$campo0."). Presione 'Cerrar', para recargar los datos ";
}
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
     // validacion acceso
    function valI(){
	if (document.u.campo0.value==""){
			alert("<? echo $AppNombre;?>: Digite por favor la <? echo $camposN[0];?>");
			document.u.campo0.focus();
			return;
     }

	     document.u.submit();
	  }
//-->
</SCRIPT>
<body>

<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");
 include($rutxx."../../incluidos_modulos/core.mensajes.php"); ?>

<? include($rutxx."../../incluidos_modulos/encabezado.php"); ?>

		<? 
			$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=0;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");


		?>
		<br />
<? include($rutxx."../../incluidos_modulos/resultoperaciones.php"); ?>

		<table width=100% align=center  cellpadding=4 cellspacing=0 style="border-bottom:<? echo $fondos[20];?>">
		<tr bgcolor="<? echo $fondos[12];?>" align=center>
		<td valign=top class=text1 colspan=2>
			<strong>Para Ingresar los datos, es necesario llenar las casillas que se encuetran a continuación. TODAS LAS CASILLAS CON OBLIGATORIAS</strong><br>
		</td>
		</tr>

		<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=text1>
			<? echo $camposN[0];?>
		</td>
		<td valign=top>
			<input type="text" name="campo0" class=text1 value="<? echo $_REQUEST['campo0'];?>" size=80 maxlength="255">
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[4];?>">
		<td valign=top class=text1>
			<? echo $camposN[2];?>
		</td>
		<td valign=top>
			<select name="campo2" class=text1>
			<option value="1" <? if ($_REQUEST['campo2']=="1"){ echo "SELECTED";}?>>SI</option>
			<option value="2" <? if ($_REQUEST['campo2']=="2"){ echo "SELECTED";}?>>NO</option>
			</select>
		</td>
		</tr>

		<tr bgcolor="<? echo $fondos[12];?>" align=center>
			<td valign=top colspan=2>
			<input type=button name=enviar value="Ingresar" class="btn_detalle botones2" onClick="valI();">
			<input type=button name=enviar value="Regresar" class="btn_detalle botones2" onClick="irAPaginaD('productos.planes.php');">
			<input type=hidden name=inn value="1">
			<input type=hidden name=tabla value="<? echo $tabla;?>">
			<input type=hidden name=dir value="<? echo $dir;?>">
			</td>
		</tr>
		</form>

	</table>
<br>
<? include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>
