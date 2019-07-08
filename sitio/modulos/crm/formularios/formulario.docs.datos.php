<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2012
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
 Preferencias datos
 */
				$iddocumento=$result->fields[0];
				$nombredocumento=$result->fields[1];
 				$sql="select id  from $tablaasoc  where ";
				$sql.=" cliente_asociado=".$idy;
				$sql.=" and documento_asociado=".$iddocumento;
//				echo $sql;
				 $resultx=$db->Execute($sql);
				 if (!$resultx->EOF) {
					$idar=1;
				} else {
					$idar=0;
				}
		   		$resultx->Close();

?>
<td>
	<div>
		<input type=checkbox name="idasoc[]" value="<? echo $iddocumento;?>" <? if ($idar=="1") echo "CHECKED";?>>
		<? echo $nombredocumento;?>
	</div>

	<? // funcion que busca mas en otras preferencias
	preferencias($iddocumento,$tabla,$tablaasoc,$idy,1);
	?>

</td>
