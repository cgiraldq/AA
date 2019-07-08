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
// celda generica de datos y comparaciones
*/
 $id=$resultx->fields[0];
 $dsm=$resultx->fields[1];
 $idbasedestino="";
 $sql="select iddestino,dsprecio1,dsprecio2,dsprecio3,dsprecio4,dsprecio5 from $tablarelaciones4 where idorigen=$idx and iddestino=$id";
 //echo $sql;
 $result = $db->Execute($sql);
 if (!$result->EOF) {
 	$idbasedestino=$resultx->fields[0];
 	$dsprecio1=$result->fields[1];
 	$dsprecio2=$result->fields[2];
 	$dsprecio3=$result->fields[3];
 	$dsprecio4=$result->fields[4];
 	$dsprecio5=$result->fields[5];
 }
 $result->Close();
?>
 <tr>
<td align="left" width="20%">
<input type="checkbox" name="sel4[]" value="<? echo $id?>" <? if ($id==$idbasedestino) echo "checked";?>>&nbsp;<? echo $dsm?>
</td>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,1)){?>
<td align="center">
<?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,2)?>
<input type="text" name="dsprecio_sel1[]" value="<? echo $dsprecio1?>" size=10 maxlength="10" class=text1>
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,1)){?>
<td align="center">
<?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,2)?>
<input type="text" name="dsprecio_sel2[]" value="<? echo $dsprecio2?>" size=10 maxlength="10" class=text1 >
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,1)){?>
<td align="center">
<?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,2)?>
<input type="text" name="dsprecio_sel3[]" value="<? echo $dsprecio3?>"  size=10 maxlength="10" class=text1>
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,1)){?>
<td align="center">
<?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',4,2)?>
<input type="text" name="dsprecio_sel4[]" value="<? echo $dsprecio4?>" size=10 maxlength="10" class=text1>
</td>
<?}?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,1)){?>
<td align="center">
<?echo seldato('dsm','idactivo','ecommerce_tblnombrecampo',5,1)?>
<input type="text" name="dsprecio_sel5[]" value="<? echo $dsprecio5?>" size=10 maxlength="10" class=text1>
</td>
<?}?>
<?
  $dsprecio1="";
  $dsprecio2="";
  $dsprecio3="";
  $dsprecio4="";
  $dsprecio5="";
?>
 </tr>

