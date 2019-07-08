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
 $ruta=$resultx->fields[2];
$txt="";
 $idbasedestino="";
 $sql="select iddestino from tblvistaxtblpaginas where idorigen='1' and iddestino=$id";
//echo $sql;
 $result = $db->Execute($sql);
 if (!$result->EOF) {
 	$idbasedestino=$resultx->fields[0];
 }
 $result->Close();
?>
<td align="left">

	<input id="cmn-toggle-<? echo $id;?>" class="cmn-toggle cmn-toggle-round" type="checkbox" name="sel[]" value="<? echo $id?>"<? if ($id==$idbasedestino) echo "checked";?>>
	<label for="cmn-toggle-<? echo $id;?>"></label>
	<p ><? echo $dsm?></p>
	<a href="vista.paginas.editar.php?idx=<? echo $id;?>">Editar</a>
</td>
