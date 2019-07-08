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
// Tabla central de datos cuando se hacen los listados
?>
<br>

<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center">
<?
// encabezado generico basado
$nombrecampos="Nombre,Referencia,Descripcion corta,Descripcion Larga,Precio Compra,Precio 1,Precio 2,precio 3,Precio 4,Precio 5,Valor flete,Procentaje Impuestos,";
$nombrecampos.="Volumen,Peso,Ancho,Alto,Largo,Fecha Inicial,Fecha Final,";
$nombrecampos.="Id Proveedor,Imagenes,Categoria,Subcategoria,Cantidad Disponible, Cantidad x Unidad,Caracteristicas,Garantias,Marca,Tallas,Colores,Idproducto";

include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
                      $dsproducto=($result->fields[0]);
                      $dsproducto=utf8_decode($dsproducto);
                      $dsproducto=htmlspecialchars_decode($dsproducto);
                      $dsproducto=html_entity_decode($dsproducto);

					  $dsd=$result->fields[2];                      
                      $dsd=utf8_encode($dsd);
                      $dsd=htmlspecialchars_decode($dsd);
                      $dsd=html_entity_decode($dsd);
                      $dsd=strip_tags($dsd);

					  $dsd2=($result->fields[3]);
                      $dsd2=utf8_decode($dsd2);
                      $dsd2=htmlspecialchars_decode($dsd2);
                      $dsd2=html_entity_decode($dsd2);
                      $dsd2=strip_tags($dsd2);

//
					  $carac=($result->fields[25]);
                      $carac=utf8_decode($carac);
                      $carac=htmlspecialchars_decode($carac);
                      $carac=html_entity_decode($carac);
                      $carac=strip_tags($carac);

					  $garantias=($result->fields[26]);
                      $garantias=utf8_decode($garantias);
                      $garantias=htmlspecialchars_decode($garantias);
                      $garantias=html_entity_decode($garantias);
                      $garantias=strip_tags($garantias);

		?>
		 <tr valign=top>
		  <td align="center"><? echo $dsproducto;?></td><!--nombre-->
		  <td align="center"><? echo reemplazar(trim($result->fields[1]))?></td><!--referencia-->
		  <td align="center"><? echo $dsd?></td><!--descri corta-->
		  <td align="center"><? echo $dsd2?></td><!--descri larga-->

		  <td  style="mso-number-format:'@'"align="center"><? echo reemplazar(trim($result->fields[4]))?></td><!--precio compra-->
		  <td  style="mso-number-format:'@'"align="center"><? echo reemplazar(trim($result->fields[5]))?></td><!--precio 1-->
		  <td  style="mso-number-format:'@'"align="center"><? echo reemplazar(trim($result->fields[6]))?></td><!--precio 2-->
		  <td  style="mso-number-format:'@'"align="center"><? echo reemplazar(trim($result->fields[7]))?></td><!--precio 3-->
		  <td  style="mso-number-format:'@'"align="center"><? echo reemplazar(trim($result->fields[8]))?></td><!--precio 4-->
		  <td  style="mso-number-format:'@'"align="center"><? echo reemplazar(trim($result->fields[9]))?></td><!--precio 5-->
		  <td  style="mso-number-format:'@'"align="center"><? echo reemplazar(trim($result->fields[10]))?></td><!--precio flete-->

		  <td align="center"><? echo reemplazar(trim($result->fields[11]))?></td><!--% iva-->
		  <td align="center"><? echo reemplazar(trim($result->fields[12]))?></td><!-- volumen-->
		  <td align="center"><? echo reemplazar(trim($result->fields[13]))?></td><!-- peso-->
		  <td align="center"><? echo reemplazar(trim($result->fields[14]))?></td><!-- ancho -->
		  <td align="center"><? echo reemplazar(trim($result->fields[15]))?></td><!-- alto -->
		  <td align="center"><? echo reemplazar(trim($result->fields[16]))?></td><!-- largo -->

		<td  style="mso-number-format:'yyyy/mm/dd'"align="center"><? echo reemplazar(trim($result->fields[17]))?></td><!-- fecha inicial -->
		<td  style="mso-number-format:'yyyy/mm/dd'"align="center"><? echo reemplazar(trim($result->fields[19]))?></td><!-- fecha final -->
<td align="center"><? echo $result->fields[20]?></td>
<?
$id=$result->fields[22];
// nombre categortia
/*==================  subcategoria ====================================*/
$sql="select iddestino from ecommerce_tblsubcategoriaxtblproducto where idorigen=$id";
$resultx= $db->Execute($sql);
$subcategoria="";
if (!$resultx->EOF) {
while (!$resultx->EOF){
$subcategoriax=$resultx->fields[0];
$subcategoriax=seldato('dsm','id','ecommerce_tblsubcategoriasxcategoria',$subcategoriax,1);
$subcategoria=$subcategoria."|".$subcategoriax;

$resultx->MoveNext();
}
}
$resultx->Close();
/*==================  Subcategorias ====================================*/
/*==================  categorias ====================================*/
$sqlx="select iddestino from tbltblproductoxcategoria where idorigen=$id";
$resultxx= $db->Execute($sqlx);
$categoria="";
if (!$resultxx->EOF) {
while (!$resultxx->EOF){
$categoriax=$resultxx->fields[0];
$categoriax=seldato('dsm','id','ecommerce_tblcategoria',$categoriax,1);
$categoria=$categoria."|".$categoriax;

$resultxx->MoveNext();
}
}
$resultxx->Close();
/*==================  Fin Categorias ====================================*/

/*==================  imagenes ====================================*/
$sqlm="select dsimg from ecommerce_tblproductoximg where iddestino=$id";
$resultm= $db->Execute($sqlm);
$dsimg="";
if (!$resultm->EOF) {
while (!$resultm->EOF){
$dsimgx=$resultm->fields[0];
$dsimg=$dsimg."|".$dsimgx;

$resultm->MoveNext();
}
}
$resultm->Close();
/*==================  fin imagenes ====================================*/

/*==================  Colores ====================================*/
$sqlx="select a.id,a.dsm,a.dsd FROM ecommerce_tblcolores a, ";
$sqlx.="ecommerce_tblcoloresxtblproducto b where b.idorigen=".$result->fields[22];
$sqlx.=" and a.id=b.iddestino and a.idactivo not in (2,9)";
$vermas_c=$db->Execute($sqlx);
if(!$vermas_c->EOF){?>
<?while (!$vermas_c->EOF) {
$color=$vermas_c->fields[1];
$colores=$colores."|".$color;
$vermas_c->MoveNext();
}
}$vermas_c->Close();
/*================== fin  Colores ====================================*/

/*================== tallas ====================================*/
?>
<?
$sql ="select a.id,a.dsm,b.dsprecio1,b.dsprecio2,b.dsprecio3,b.dsprecio4,b.dsprecio5";
$sql.=" FROM ecommerce_tbltallas a,ecommerce_tbltallasxtblproducto b where b.idorigen=$id";
$sql.=" and a.id=b.iddestino and a.idactivo not in (2,9)";
$vermas_t=$db->Execute($sql);
if(!$vermas_t->EOF){
while (!$vermas_t->EOF) {
$dsmtalla=$vermas_t->fields[1];
$tallas=$tallas."|".$dsmtalla;
$vermas_t->MoveNext();
}
}$vermas_t->Close();
/*================== fin  tallas ====================================*/
?>

		<?$tallas=trim($tallas,"|");?>
		<?$dsimg=trim($dsimg,"|");?>
		<?$colores=trim($colores,"|");?>
		<?$categoria=trim($categoria,"|");?>
		<?$subcategoria=trim($subcategoria,"|");?>
		<td align="center"><? echo $dsimg?></td>
		<td align="center"><? echo reemplazar($categoria)?></td>
		<td align="center"><? echo reemplazar($subcategoria)?></td>


		  <td align="center"><? echo $result->fields[21];//unidades disponibles?></td>
		  <td align="center"><? echo $result->fields[23];//cantida por unidad?></td>
		  <td align="center"><? echo $carac;//caracteristicas?></td>
		  <td align="center"><? echo $garantias;//garantia?></td>
		  <td align="center"><? echo reemplazar($result->fields[27]);//dsmarca?></td>
		  <td align="center"><? echo reemplazar($tallas);//Talla?></td>
		  <td align="center"><? echo reemplazar($colores);//Color?></td>
		  <td align="center"><? echo $result->fields[22]; // idproducto?></td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while

?>

</table>
