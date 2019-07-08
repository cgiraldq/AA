<?

$sql="select  a.id, a.dsm,idcertinscripcion,idimprcertins,b.idfechai,b.idfechaf,b.idhorai,b.idhoraf ";
							$sql.=" from  tbltipovotacion a,tblvotacionfechainscripcion b ";
							$sql.=" where  a.id=b.idtv and a.idactivo in (1) and b.idactivo=1";
							$sql.=" and ($fechafull between b.idfechaini and b.idfechafin) ";
					//		$sql.=" and ($horafull between b.idhorai and b.idhoraf) ";
//echo $sql;

$result=$db->Execute($sql);
	if (!$result->EOF) {
?>
	<div class="line_contenidos"></div>

		<h3>En estos momentos se encuentran abiertas las inscripciones para:</h3>
			<table cellpadding="3" cellspacing="3" class="tbl_voto">
				<tr>
					<td bgcolor="#F3F9CF"><h2>Tipo</h2></td>

					<td bgcolor="#F3F9CF"><h2>Opciones</h2></td>

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
					//echo $fechabasei." --  ".date("YmdHi")." --  ".$fechabasef;

					$nombre_archivo=$idtv."_".$_SESSION['i_codigo']."_inscrito.pdf";

	        $sql="select id,fecharegistro from tblcandidatos where id>0 ";
			$sql.=" and dscedula='".$_SESSION['i_cedula']."' and idtipov=$idtv and idactivo<>999 ";
//echo $sql;
			$valido=0;
			$fecharegistro="";
			$resultv=$db->Execute($sql);
			if (!$resultv->EOF)  {
				$valido=1;
					$fecharegistro=$resultv->fields[1];

			}
			$resultv->Close();
			//echo $valido;

				// traer el mensaje inhabil
				$sql="select dsmensaje from tblvotacionmensajesasociados where idtv=$idtv and idactivo=1";
				$resultx=$db->Execute($sql);
				$dsmensajeinhabil="";
				if (!$resultx->EOF) {
				// habil puede votar
					$dsmensajeinhabil=$resultx->fields[0];

				}
				$resultx->Close();

			// validacion si el asociado esta habil o no para este tipo de votacion
			$sql="select a.id from  tblvotacionasociados a, tblvotacionasociados_temp b where b.dscodigo=a.dscodigo ";
			$sql.=" and b.dscodigo='".$_SESSION['i_cedula']."' and a.idtipov=".$idtv;
				$resultx=$db->Execute($sql);
				if (!$resultx->EOF) {

			//echo $valido." --".$sincerinscri." -- ".$mostrarcerinscri;

			?>

				<tr>
					<td ><p><strong><? echo $dsm?></strong></p></td>
					<td>
					<?
					// validacion de existencia del candidato para generar el certificado

					if ($valido==1 && $sincerinscri=="1" && $mostrarcerinscri=="1") {
					?>
					Usted ya se inscribi&oacute; y no es necesario volver a hacerlo.<br>
					Fecha de registro: <? echo $fecharegistro?>
					<br>
					<a href="asociados_votaciones.inscripciones.generar.pdf.php?idtv=<? echo $idtv?>&dstv=<? echo $dsm?>&idx=<? echo $idx;?>&dsx=<? echo $dsx;?>&idy=<? echo $idy;?>&dsy=<? echo $dsy;?>" title="Click para generar Certificado"class="btn_color"><p>Certificado</p></a>
					<? } else { ?>
					<a href="asociados_votaciones.inscripciones.ficha.php?idtv=<? echo $idtv?>&dstv=<? echo $dsm?>&idx=<? echo $idx;?>&dsx=<? echo $dsx;?>&idy=<? echo $idy;?>&dsy=<? echo $dsy;?>" title="Click para postularse" class="btn_color"><p>Postularse</p></a>
					<? } ?>
					</td>
				</tr>


<?		} else {
		// mensaje de inhabil
		?>
			<tr>

				<td ><p><strong> <? echo $dsm?></strong><p></td>
				<td ><p><? echo $dsmensajeinhabil?><p></td>

				</tr>


		<?
		}
		$resultx->Close();


									$result->MoveNext();

		}

?>



			</table>
<?
} else {
?>
		<div class="line_contenidos"></div>

			<span class="txt_azul1">En estos momentos no se encuentran procesos de inscripciones activos</span>

<?

}
$result->Close();

?>