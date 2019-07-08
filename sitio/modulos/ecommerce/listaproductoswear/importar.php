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
$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="<a href='../listaproductos/default.producto.php' class='textlink' title='Principal'>Productos</a>  /  ";

	$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
	//$papelera=1;
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");?>

<section id="bloq_Importacion">
	<h2>Importar datos de Productos</h2>
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
			<td class="td1">Operaci&oacute;n a Realizar</td>
			<td class="td2">
			<select name="tipo">
				<option value="1">Primera vez</option>
				<option value="2">Multiple</option>
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
				Tama&ntilde;o permitido: <? echo ini_get("upload_max_filesize");?>
				</td>
			</tr>
		</table>
		</form>
	</section>
	<section class="bloq-infoImportante">
		<h3>*Para tener en cuenta</h3>
		<ol>

			<li>La extension del archivo para la importacion de datos debe ser <span>.xls</span></li>
			<li>Si el archivo tiene varias pestañas, estas se deben separar en archivos diferentes.</li>
			<li>El formato para precios y descuentos en el producto es de solo <span>números</span></li>
			<li>El formato para las fechas es: <span>AAAA/MM/DD/</span></li>
			<li>Descargar archivo ejemplo del archivo de excel <a href="../../incluidos_modulos/descargar.php?file=formato_importar.xls&tipo=1" class="enlace-dow"> archivo </a></li>
			<li>Si en operacion a realizar es <span>PRIMERA VEZ</span>, el sistema quita codigos html y deja los textos sin formato para que usted los edite de manera posterior.</li>
			<li>Si en operacion a realizar es <span>MULTIPLE</span>, el sistema conserva el formato de los textos de los contenidos a subir.</li>
			<li>Si exporta los productos desde el sistema, recuerde <span>REGRABAR</span> el archivo como excel extension <span>.xls</span>, haciendo click sobre <span>"Guardar Como"</span> si va a editar y volver a subirlos</li>
			<li>Al exportar los productos desde el sistema, el sistema coloca al final una columna llamada <span>"Idproducto"</span>. Por favor no la modifique al momento de subir de nuevo el archivo</li>
			<li>Si desea agregar un producto al archivo exportado, por favor deje en blanco la columna <span>"Idproducto"</span></li>
			<li>El archivo permite colocar los nombres de imagenes, separados por pipe <span>|</span>. Recuerde que debe subir las imagenes via FTP a la carpeta contenidos/images/productos/</li>
			
			<li>Coloque la cantidad de producto. Si no posee, el sistema ingresara <span>1 como defecto</span>. Si la cantidad digitada en el achivo es menor a la actual, no se carga. Si solo esta cargando el producto pero no tiene disponibilidad, coloque <span>0</span> </li>
			<li>Los precios deben ir en formato general. Si aplica el formato <span>currency</span>, el sistema no podra calcular los valores en el pedido.</li>
			<li>El peso es en kilogramos</li>
			<li>Alto, Ancho y Alto en cms</li>
			<li>Si la casilla de peso esta vacia, el sistema asume que el transporte esta incluido </li>
			<li>Si colocan en la casilla de peso cero (0),el sistema asume un peso de <span>1 kilo</span></li>
			<li>El archivo debe estar formateado como EXCEL. Si exporta el archivo,Entra a EXCEL y le dice "Guardar como" y le coloca como excel o extension xls.</li>


		</ol>
	</section>
	<section class="bloq-listas">
		<h3>Lista de Marcas</h3>
		<p>Para la carga de las marcas en el archivo debes tener encuenta el id de las marcas</p>
		<table>
			<thead>
				<tr>
					<td>Id</td>
					<td>Nombre</td>
				</tr>
			</thead>
				<?
				    $sql="select a.id,a.dsm";
			        $sql.=" from ecommerce_tblmarcas a";
			        $sql.=" where a.id >0 ";
			        $sql.=" and a.idactivo not in (9,2) ";
			        $sql.=" order by a.id ASC ";
			        $result = $db->Execute($sql);
			        if(!$result->EOF){
			    ?>
			<tbody>
				<?
					while (!$result->EOF) {
						$id=trim(reemplazar($result->fields[0]));
						$dsm=trim(reemplazar($result->fields[1]));
				?>
				<tr>
					<td class="td1"><?echo $id?></td>
					<td class="td2"><?echo $dsm?></td>
				</tr>
		        <?
			        $result->MoveNext();
			        }
				?>
			</tbody>
				<?
					}
					$result->Close();
				?>
		</table>
	</section>
	<section class="bloq-listas">
		<h3>Lista de Proveedores</h3>
		<p>Para la carga de los proveedores en el archivo debes tener encuenta el id de los proveedores</p>
		<table>
			<thead>
				<tr>
					<td>Id</td>
					<td>Nombre</td>
				</tr>
			</thead>
				<?
				    $sql="select a.id,a.dsm";
			        $sql.=" from tblproveedores a";
			        $sql.=" where a.id >0 ";
			        $sql.=" and a.idactivo not in (9,2) ";
			        $sql.=" order by a.id ASC ";
			        $result = $db->Execute($sql);
			        if(!$result->EOF){
			    ?>
			<tbody>
				<?
					while (!$result->EOF) {
						$id=trim(reemplazar($result->fields[0]));
						$dsm=trim(reemplazar($result->fields[1]));
				?>
				<tr>
					<td class="td1"><?echo $id?></td>
					<td class="td2"><?echo $dsm?></td>
				</tr>
		        <?
			        $result->MoveNext();
			        }
				?>
			</tbody>
				<?
					}
					$result->Close();
				?>
		</table>
	</section>
	<section class="bloq-listas">
		<h3>Lista de Categorias</h3>
		<p>Para la carga de las categoria en el archivo debes tener encuenta el id de las categoria.</p>
		<p class="pinfo">Si se desea relacionar el producto con varias categoria por favor separar cada una con el simbolo pipe ( <span>|</span> )</p>
		<table>
			<thead>
				<tr>
					<td>Id</td>
					<td>Nombre</td>
				</tr>
			</thead>
				<?
				    $sql="select a.id,a.dsm";
			        $sql.=" from tblcategoria a";
			        $sql.=" where a.id >0 ";
			        $sql.=" and a.idactivo not in (9,2) ";
			        $sql.=" order by a.id ASC ";
			        $result = $db->Execute($sql);
			        if(!$result->EOF){
			    ?>
			<tbody>
				<?
					while (!$result->EOF) {
						$id=trim(reemplazar($result->fields[0]));
						$dsm=trim(reemplazar($result->fields[1]));
				?>
				<tr>
					<td class="td1"><?echo $id?></td>
					<td class="td2"><?echo $dsm?></td>
				</tr>
		        <?
			        $result->MoveNext();
			        }
				?>
			</tbody>
				<?
					}
					$result->Close();
				?>
		</table>
	</section>
	<section class="bloq-listas">
		<h3>Lista de Sub-categoria</h3>
		<p>Para la carga de las Sub-categoria en el archivo debes tener encuenta el id de las Sub-categoria.</p>
		<p class="pinfo">Si se desea relacionar el producto con varias Sub-categoria por favor separar cada id con el simbolo pipe ( <span>|</span> )</p>
		<table>
			<thead>
				<tr>
					<td>Id</td>
					<td>Nombre</td>
				</tr>
			</thead>
				<?
				    $sql="select a.id,a.dsm";
			        $sql.=" from tblsubcategoriasxcategoria a";
			        $sql.=" where a.id >0 ";
			        $sql.=" and a.idactivo not in (9,2) ";
			        $sql.=" order by a.id ASC ";
			        $result = $db->Execute($sql);
			        if(!$result->EOF){
			    ?>
			<tbody>
				<?
					while (!$result->EOF) {
						$id=trim(reemplazar($result->fields[0]));
						$dsm=trim(reemplazar($result->fields[1]));
				?>
				<tr>
					<td class="td1"><?echo $id?></td>
					<td class="td2"><?echo $dsm?></td>
				</tr>
		        <?
			        $result->MoveNext();
			        }
				?>
			</tbody>
				<?
					}
					$result->Close();
				?>
		</table>
	</section>
	<!--section class="bloq-listas">
		<h3>Lista de Sub-categoria 2</h3>
		<p>Para la carga de las Sub-categoria 2 en el archivo debes tener encuenta el id de las Sub-categoria 2.</p>
		<p class="pinfo">Si se desea relacionar el producto con varias Sub-categoria 2 por favor separar cada id con punto y coma ( <span>;</span> )</p>
		<table>
			<thead>
				<tr>
					<td>Id</td>
					<td>Nombre</td>
				</tr>
			</thead>
				<?
				  /*  $sql="select a.id,a.dsm";
			        $sql.=" from tblsubcategoria2 a";
			        $sql.=" where a.id >0 ";
			        $sql.=" and a.idactivo not in (9,2) ";
			        $sql.=" order by a.id ASC ";
			        $result = $db->Execute($sql);
			        if(!$result->EOF){
			        	*/
			    ?>
			<tbody>
				<?
				/*9	while (!$result->EOF) {
						$id=trim(reemplazar($result->fields[0]));
						$dsm=trim(reemplazar($result->fields[1]));
						*/
				?>
				<tr>
					<td class="td1"><?echo $id?></td>
					<td class="td2"><?echo $dsm?></td>
				</tr>
		        <?
			      //  $result->MoveNext();
			       // }
				?>
			</tbody>
				<?
					//}
					//$result->Close();
				?>
		</table>
	</section-->
</section>
	<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>
</body>
</html>