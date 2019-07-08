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
 $sql="select iduso from $tablarelaciones where idprod=$idx and iduso=$id";
 //echo $sql;
 $result = $db->Execute($sql);
 if (!$result->EOF) {
 	$idbasedestino=$resultx->fields[0];
 }
 $result->Close();
?>
<td align="left">
<input type="checkbox" name="sel[]" value="<? echo $id?>" <? if ($id==$idbasedestino) echo "checked";?>>&nbsp;<? echo $dsm?>
</td>
