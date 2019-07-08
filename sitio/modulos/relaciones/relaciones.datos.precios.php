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
*///$db->debug=true;
 $id=$resultx->fields[0];
 $dsm=$resultx->fields[1];
 if($idtienda>1 && $tabla=="tblbanners"){
 $idtiendax=$resultx->fields[2];
 $dsref=$resultx->fields[3];
 }else{
 $dsref=$resultx->fields[2];
}
$txt="";
if ($idtiendax<>"") {
	$txt=" - (<strong>".seldato("dsnombre","id","tblempresa",$idtiendax,1)."</strong>)";
}
 $idbasedestino="";
 $sql="select iddestino,idprecio from $tablarelaciones where (idorigen=$idx or dscategoria='$dsm') and iddestino=$id"; 
 //echo $sql."<br>";
 $result = $db->Execute($sql);
 if (!$result->EOF) {
 	$idbasedestino=$resultx->fields[0];
    $idprecio=$result->fields[1];
 }
 $result->Close();
?>
<td align="left">
<input type="checkbox" name="sel[]" value="<? echo $id?>" <? if ($id==$idbasedestino) echo "checked";?>>&nbsp;<? echo $dsm?> <? echo $txt?>
<input type="hidden" name="ref[]" value="<?echo $dsref?>">
</td>
