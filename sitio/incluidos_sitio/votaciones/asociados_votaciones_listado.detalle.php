<?
// Detalle del candidato con opcion en popup de ver la ficha
// detalle

$dsmx=formateo_caracteres($result->fields[1]);
$idcandidatox=$result->fields[2];
$idfichax=$result->fields[0];
$imgx=$result->fields[3];

?>
		    			<td align="center" valign="top">
		 <a href="javascript:abrirFicha('asociados_votaciones.verficha.php?idtv=<? echo $idtv?>&dstv=<? echo $dstv?>&idy=<? echo $idy?>&dsy=<? echo $dsm?>&idx=<? echo $idx?>&dsx=<? echo $dsx?>&idfichax=<? echo $idfichax?>&idcandidatox=<? echo $idcandidatox?>&dscandidatox=<? echo $dsmx?>');" class="txt_negro4">
		<? if (is_file($dsrutay.$imgx)){?>
		<img src="<? echo $dsrutay.$imgx?>" border="0" width="110" height="110" alt="Click para ver la ficha"  />
		    			<? } else {  ?>
<img src="iconos/candidato.jpg" border="0"  alt="Click para ver la ficha"  />
				
		<? } ?>						
						</a><br/>
							<strong><a href="javascript:abrirFicha('asociados_votaciones.verficha.php?idtv=<? echo $idtv?>&dstv=<? echo $dstv?>&idy=<? echo $idy?>&dsy=<? echo $dsm?>&idx=<? echo $idx?>&dsx=<? echo $dsx?>&idfichax=<? echo $idfichax?>&idcandidatox=<? echo $idcandidatox?>&dscandidatox=<? echo $dsmx?>" title="Click para ver la ficha" class="txt_negro4"><? echo $dsmx;?></a></strong>
		    			<br>
						<?
						// armazon de seleccionador de candidato
						$cadena=$idcandidatox."|".$idfichax."|".$dsmx;
						?>
						<input name="idcandidato[]"  type="checkbox" value="<? echo $cadena;?>" onClick="MaxiVot();">
						</td>
