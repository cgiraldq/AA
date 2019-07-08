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
 $idtiendax=$resultx->fields[2];
$txt="";
if ($idtiendax<>"") {
	$txt=" - (<strong>".seldato("dsnombre","id","tblempresa",$idtiendax,1)."</strong>)";
}
 $idbasedestino="";
 $idposn="";
if($posicion==1)$mostrarpos=",idpos";
 $sql="select iddestino$mostrarpos from $tablarelaciones1 where idorigen='$idx' and iddestino='$id';";
 //echo $sql;
 $result = $db->Execute($sql);
 if (!$result->EOF) {
 	$idbasedestino=$result->fields[0];
 	$idposn=$result->fields[1];

 }
 $result->Close();
?>
<td>
	<? if($posicion==1){?>
<input  placeholder="Pos" maxlength="3" size="1" type="text" name="pos[<? echo $id;?>]" value="<? echo $idposn;?>">
<?}?>
</td>
<td align="left">

<input type="checkbox" name="sel1[]" value="<? echo $id?>" <? if ($id==$idbasedestino) echo "checked";?>>&nbsp;<? echo $dsm?> <? echo $txt?>
</td>
