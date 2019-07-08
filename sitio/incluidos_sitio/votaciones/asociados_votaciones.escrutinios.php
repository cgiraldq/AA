<?

// validar ademas que este activo


$sql="select  a.id, a.dsm,a.idcertvotacion,a.idimprcervot,b.idfechai,b.idfechaf,b.idhorai,b.idhoraf,a.dstexto ";
							$sql.=" from  tbltipovotacion a,tblvotacionfechaescrutinios b ";
							$sql.=" where  a.id=b.idtv and a.idactivo in (1) and b.idactivo=1  ";
							$sql.=" and ($fechafull between b.idfechaini and b.idfechafin) ";
//echo $sql;										
								
$result=$db->Execute($sql);
	if (!$result->EOF) {

	
	
?>
			<div class="line_contenidos"></div>
			
			<span class="txt_azul1">Procesos de Escrutinios para:</span>
			<table style="width: 100%; border:1px #DDD solid; margin: 5px 0" cellpadding="3" cellspacing="3">
				<tr>
					<td bgcolor="#F6F6F6"><strong>Tipo</strong></td>
					
					<td bgcolor="#F6F6F6"><strong>&nbsp;</strong></td>
					
				</tr>
			<?
				$total=$result->RecordCount();
				$i=1;
				while (!$result->EOF) {
					$idtv=$result->fields[0];
					$dsm=$result->fields[1];
					$sincerinscri=$result->fields[2];
					$mostrarcerinscri=$result->fields[3];
					
					
					$idfechai=$result->fields[4];
					$idfechaf=$result->fields[5];
					
					$idhorai=$result->fields[6];
					if (strlen($idhorai)<4) $idhorai="0".$idhorai;
					$idhoraf=$result->fields[7];
					if (strlen($idhoraf)<4) $idhoraf="0".$idhoraf;
					
					$fechabasei=$idfechai.$idhorai;
					$fechabasef=$idfechaf.$idhoraf;
					$fechabase=date("YmdHi");
					$dstexto=$result->fields[8];
					$dstexto=preg_replace("/\n/","<br>",$dstexto);
					
				
			?>
					
				<tr>
					<td ><? echo $dsm?></td>
				</tr>	
					<td>
					<? echo $dstexto?>
					</td>
				</tr>
								
				
				<? 
				
	

			$result->MoveNext();

		}
		
?>				



			</table>
<?
} else {
?>
	
<?
	
}
$result->Close();

?>