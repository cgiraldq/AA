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
 $idpreferencia=$result->fields[0];
 $nombrepreferencia=$result->fields[1];
 				$sql="select id  from $tablaasoc  where ";
				$sql.=" idproducto=".$idy;
				$sql.=" and idasoc=".$idpreferencia;
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
				<input type=checkbox name="idasoc[]" value="<? echo $idpreferencia;?>" <? if ($idar=="1") echo "CHECKED";?>>
				<strong><? echo $nombrepreferencia;?></strong>

<br>
				<? // funcion que busca mas en otras preferencias
					preferencias($idpreferencia,$tabla,$tablaasoc,$idy,1);
				?>


				</td>
