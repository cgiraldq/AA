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
// $db->debug=true;
$idx=$_REQUEST['idx'];
$param=$_REQUEST['param'];
$campo=$_REQUEST['campo'];
$letra=$_REQUEST['letra'];
$idnatx=$_REQUEST['idnatx'];
$idactivox=$_REQUEST['idactivox'];
$idcliente=$_REQUEST['idcliente'];
$dscliente=$_REQUEST['dscliente'];
$idprograma=$_REQUEST['idprograma'];
$dsprograma=$_REQUEST['dsprograma'];
$idtipob=$_REQUEST['idtipob'];
$idsubcatx=$_REQUEST['idsubcatx'];
$sinprecio=$_REQUEST['sinprecio'];
$sintrans=$_REQUEST['sintrans'];
$sindescuento=$_REQUEST['sindescuento'];
$sinimagen=$_REQUEST['sinimagen'];
$sinref=$_REQUEST['sinref'];
$sindesc=$_REQUEST['sindesc'];
$ordenar=$_REQUEST['ordenar'];
$campoletra=$_REQUEST['campoletra'];

$rr="default.producto.php?idtipoprod=$idtipoprod&pagina=$paginax";
$rr.="param=$param&campo=$campo&letra=$letra&idactivo=$idactivox&idnatx=$idnatx&idactivox=$idactivox&idcliente=$idcliente";
$rr.="&dscliente=$dscliente&idprograma=idprograma&dsprograma=$dsprograma&idtipob=$idtipob&idsubcatx=$idsubcatx&sinprecio=$sinprecio&sintrans=$sintrans";
$rr.="&sindescuento=$sindescuento&sinimagen=$sinimagen&sinimagen_1=$sinimagen&sinref=$sinref&sindesc=&ordenar=$ordenar&idmarca=$idmarca&campoletra=$campoletra";

include("producto.editar.procesos.php");
$nombre=seldato('dsm','id','ecommerce_tblproductos',$idx,1);
?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body onload="mostar_tallas('<?echo $idx?>','0');">
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.producto.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center"  border=1 class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


		<table width="70%"  cellpadding="0" cellspacing="0" class="texto_centro" >
		        <tr>
		         	<td width="615" align="left" valign="middle">
		        		<img src="../../../img_modulos/modulos/edicion.png">
		         		<h1>Edicion del registro seleccionado</h1>
		         	</td>
		        </tr>
		</table>

		<table align="center"  cellspacing="1" cellpadding="5"  width=70% class="campos_ingreso">
			<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

				<tr>
					<td align="center" colspan="2" style="text-align: right;">
						<?
						$forma="u";
						$param="dsm";
						$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
						include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
						<input type=hidden name=idx value=<?echo $idx?>>
						<input type=hidden name=idtipoprod value=<?echo $idtipoprod?>>
					</td>
				</tr>


				<tr valign=top bgcolor="#FFFFFF">
					<td></td>
					<td align=right>
								<a href="../../../ecommerce.productos.detalle.php?vistaprevia=1&idproducto=<? echo $idx?>" target="_blank" title="Click para ver el producto antes de publicarlo" class="btn_barra">
									Vista previa
								</a>

					</td>
				</tr>

				<tr>
					<td colspan=3>

					<table class="cont_botones_table">
						<tr>
							<td colspan="3">
								<article  id='cont_botones'class="cont_botones">
									<ul class='tabs'>
									    	<li><a href='#informacion_producto'><p>Información</p></a></li>
										    <li><a href='#caracteristicas_producto'><p>Características</p></a></li>
									    	<li><a href='#imagenes_producto'><p>Imágenes</p></a></li>
										    <li><a href='#tallas'><p>Tallas y Colores</p></a></li>
										    <li><a href='#precio_producto'><p>Impuestos y flete</p></a></li>
									</ul>
								</article>
							</td>
						</tr>
					</table>
					</td>
				</tr>

				<?//$db->debug=true;?>
				<?include("informacion.producto.php");?>
				<?include("imagenes.producto.php");?>
				<?include("precios.producto.php");?>
				<?include("caracteristicas.producto.php");?>
				<?//include("tallas.colores.php");?>
				<?include("tallas.php");?>
				<input type="hidden" name="param"  value="<?echo $param?>">
				<input type="hidden" name="campo"  value="<?echo $campo?>">
				<input type="hidden" name="letra"  value="<?echo $letra?>">
				<input type="hidden" name="idnatx"  value="<?echo $idnatx?>">
				<input type="hidden" name="idactivox"  value="<?echo $idactivox?>">
				<input type="hidden" name="idcliente"  value="<?echo $idcliente?>">
				<input type="hidden" name="dscliente"  value="<?echo $dscliente?>">
				<input type="hidden" name="idprograma"  value="<?echo $idprograma?>">
				<input type="hidden" name="dsprograma"  value="<?echo $dsprograma?>">
				<input type="hidden" name="idtipob"  value="<?echo $idtipob?>">
				<input type="hidden" name="idsubcatx"  value="<?echo $idsubcatx?>">
				<input type="hidden" name="sindesc"  value="<?echo $sindesc?>">
				<input type="hidden" name="sintrans"  value="<?echo $sintrans?>">
				<input type="hidden" name="sinprecio"  value="<?echo $sinprecio?>">
				<input type="hidden" name="sindescuento"  value="<?echo $sindescuento?>">
				<input type="hidden" name="sinref"  value="<?echo $sinref?>">
				<input type="hidden" name="ordenar"  value="<?echo $ordenar?>">
				<input type="hidden" name="campoletra"  value="<?echo $campoletra?>">
				<input type="hidden" name="paginax"  value="<?echo $paginax?>">
				<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
				<tr>
					<td align="center" colspan="2" style="text-align: right;">
					<?
					$forma="u";
					$param="dsm";
					include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
					<input type=hidden name=idx value=<?echo $idx?>>
					<input type=hidden name=idtipoprod value=<?echo $idtipoprod?>>
					</td>
				</tr>

					<tr valign=top bgcolor="#FFFFFF">
					<td></td>
					<td align=right>
					<a href="<? echo $rutaAbs?>productos.detalle.php?idproducto=<? echo $idx?>" target="_blank" title="Click para ver el producto antes de publicarlo" class="btn_barra">
					Vista previa
					</a>
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
