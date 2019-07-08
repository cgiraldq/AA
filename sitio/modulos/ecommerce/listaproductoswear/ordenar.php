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
//include("producto.editar.procesos.php");
//$db->debug=true;
$idordenarx=$_REQUEST['idordenarx'];
$ordenar=$_REQUEST['ordenar'];
if($ordenar<>""){
$sqlx="delete  from tblordenar where 1";
$resultx=$db->Execute($sqlx);
if (!$resultx->EOF){
$sqly="insert into tblordenar (dsm) values('$ordenar')";
$db->Execute($sqly);
}else{
	$sqly="insert into tblordenar (dsm) values('$ordenar')";
	$db->Execute($sqly);
}
$resultx->Close();
}

$sql="select id,dsm from tblordenar where 1";
$result=$db->Execute($sql);
if (!$result->EOF){
$ordenar=$result->fields[1];
$idordenar=$result->fields[0];
}
$result->Close();
?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");
	?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center"  border=1 class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


		<table width="70%"  cellpadding="0" cellspacing="0" class="texto_centro" >
		        <tr>
		         	<td width="615" align="left" valign="middle">
		        		<img src="../../../img_modulos/modulos/edicion.png">
		         		<h1> Ordenamiento del producto sitio web</h1>
		         	</td>
		        </tr>
		</table>

		<table align="center"  cellspacing="1" cellpadding="5"  width=70% class="campos_ingreso">
			<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

				<tr valign=top bgcolor="#FFFFFF">
					<td colspan="2">
					<strong>Ordernar Producto en el sitio por :</strong>
					<br>
						<br>
							<br>
					<table width="100%" border="0" cellpadding="2" cellspacing="0" class="text1">
						<tr>	
							<td align="left">
								<input type="radio" name="ordenar" value="1" <? if ($ordenar=="1") echo "checked";?>>&nbsp;Ordenar De A-Z 
							</td>
							<td align="left">
								<input type="radio" name="ordenar" value="2" <? if ($ordenar=="2") echo "checked";?>>&nbsp;Ordenar De Z-A 
							</td>
							<td align="left">
								<input type="radio" name="ordenar" value="3" <? if ($ordenar=="3") echo "checked";?>>&nbsp;Ordenar Precio De Menor  a Mayor
							</td>
							<td align="left">
								<input type="radio" name="ordenar" value="4" <? if ($ordenar=="4") echo "checked";?>>&nbsp;Ordenar Precio De Mayor  a Menor
							</td>
							</tr>
							<tr valign=top bgcolor="#FFFFFF">
							<td align="left">
								<input type="radio" name="ordenar" value="5" <? if ($ordenar=="5") echo "checked";?>>&nbsp;Ordenar Referecncia A-Z
							</td>
							<td align="left">
								<input type="radio" name="ordenar" value="6" <? if ($ordenar=="6") echo "checked";?>>&nbsp;Ordenar Referecncia Z-A
							</td>
						</tr>
					</table>		
					</td>
				</tr>

				<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
				<tr>
					<td align="center" colspan="2" style="text-align: right;">
							
					<input type=submit value="Modificar" name="modificar" class="botones">
					<input type=button name=enviary value="Regresar" onClick="irAPaginaD('default.producto.php')"  class="botones">
					<input type=hidden name=ordenarx value=<?echo $idordenar?>>
					
					</td>
				</tr>

				
			</table>		
			</form>
		</table>

	</td>

</tr>
</table>
<br>
	<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>
