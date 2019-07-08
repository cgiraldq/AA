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
// principal
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Importar Productos";


?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
$rutamodulo="<a href='../../modulos/core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="<a href='../listaproductos/default.producto.php' class='textlink' title='Principal'>Productos</a>  /  ";

	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$papelera=1;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");?>

<section id="bloq_Importacion">
	<h2>Importar Archivo</h2>
	<section class="bloq-formulario">
		<form action="importar.datos.php" name="importar" enctype="multipart/form-data" method="post">
		<table align="center" width="100%" border="0" class="table-importar">
			<tr>
			<td class="td1">Archivo</td>
			<td class="td2"><input type="file"  name="userfile1"></td>
			</tr>
			<tr>
			<td class="td3" colspan="2">Si no puede subir el archivo. Recuerde que debe subirlo via FTP a la carpeta <span>contenidos/images/productos/</span></td>
			</tr>
			<tr>
			<td class="td1">Por favor digite aca el nombre</td>
			<td><input type="text" class="td2" name="dsarchivo"></td>
			</tr>

			<tr>
			<td class="td1">Tipo de archivo</td>
			<td class="td2">
			<select name="idtipoarchivo">
				<option value="1">Excel  (.xls)</option>
			</select>
			</td>
			</tr>
			<tr>
			<td class="td1">Operaci&oacute;n Realizada</td>
			<td class="td2">
			<select name="tipo">
				<option value="1">Primera vez</option>
				<option value="2">Multiple ocacion</option>
			</select>
			</td>
			</tr>

			<tr>
			<td class="td1">Tipo de Operación</td>
			<td class="td2">
			<select name="idoperacion">
				<option value="1">Guardar  datos</option>
				<!--option value="2">Eliminar datos</option-->
			</select>
			</td>
			</tr>

			<tr>
				<td colspan="2" class="td-btn">
				<input type=button name=enviar value="Regresar" class="formbt1" onclick="location.href='default.php'" title="Click para subir el archivo ">
				<input type=submit name=enviar value="Cargar archivo" class="formbt1" onClick="" title="Click para subir el archivo ">
				</td>
			</tr>
			<tr>
				<td colspan="2" class="td4">
				Tama&ntilde;o m&aacute;ximo permitido: <? echo ini_get("upload_max_filesize");?>
				</td>
			</tr>
		</table>
		</form>
	</section>
	<section class="bloq-infoImportante">
		<h3>*Para tener en cuenta</h3>
		<ol>
			<li>La extensi&oacute;n del archivo para la importaci&oacute;n de datos debe ser <span>.xls</span></li>
			<li>Si el archivo tiene varias pestañas, estas se deben separar en archivos diferentes.</li>

			<li>El formato para las fechas es: <span>DD/MM/AAAA</span></li>
			<li>Descargar archivo ejemplo del archivo de excel <a href="../../../incluidos_modulos/descargar.php?file=formato_importar.xls&tipo=1" class="enlace-dow"> archivo </a></li>
			<li>Si exporta los productos desde el sistema, recuerde guardar el archivo como excel extension <span>.xls</span></li>

			<li>El archivo debe estar formateado como EXCEL.
			 Si exporta el archivo,Entra a EXCEL y le dice "Guardar como" y le coloca como excel o extension xls.</li>
		</ol>
	</section>


</section>
	<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>
</body>
</html>