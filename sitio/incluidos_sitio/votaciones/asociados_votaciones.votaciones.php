<?

// validar ademas que este activo

$dscedula=$_SESSION['i_cedula'];
$codigo=$_SESSION['i_cedula'];

$sql="select  a.id, a.dsm,a.idcertvotacion,a.idimprcervot,b.idfechai,b.idfechaf,b.idhorai,b.idhoraf ";
							$sql.=" from  tbltipovotacion a,tblvotacionfechavotacion b ";
							$sql.=" where  a.id=b.idtv and a.idactivo in (1) and b.idactivo=1  ";
							$sql.=" and ($fechafull between b.idfechaini and b.idfechafin) ";
//echo $sql;

$result=$db->Execute($sql);
	if (!$result->EOF) {



?>
			<h3>Procesos de votaci&oacute;n para:</h3>
			<table cellpadding="3" cellspacing="3" class="tbl_voto">
				<tr>
					<td bgcolor="#F3F9CF"><h2>Tipo</h2></td>

					<td bgcolor="#F3F9CF"></td>

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
				// habil puede votar

			$nombre_archivo=$idtv."_".$_SESSION['i_codigo']."_inscrito.pdf";

	        $sql="select id from tblvotacionresultados_votos where (dscodigo='".$codigo."' or dscedula='".$codigo."') and idtipov=$idtv ";

			$valido=0;

			$resultv=$db->Execute($sql);
			if (!$resultv->EOF) $valido=1;
			$resultv->Close();
			//echo $valido;
			$dstv=$dsm;
			?>

				<tr>
					<td ><p><strong><? echo $dsm?></strong></p></td>
					<td>
					<?
					// validacion de existencia del candidato para generar el certificado

					if ($valido==1 && $sincerinscri=="1" && $mostrarcerinscri=="1") {
					?>
					Usted ya voto y no es necesario volver a hacerlo.
					<br>
					<a href="asociados_votaciones.votaciones.pdf.php?idtv=<? echo $idtv?>&dstv=<? echo $dsm?>&idx=<? echo $idx;?>&dsx=<? echo $dsx;?>&idy=<? echo $idy;?>&dsy=<? echo $dsy;?>" title="Click para generar Certificado" class="btn_color"><p>Certificado</p></a>
					<? } else { ?>

					<? } ?>
					</td>
				</tr>
				<?
				if ($valido==0) {
				?>
				<tr bgcolor="#F3F9CF">
					<td colspan=2><h2>LISTADO DE CANDIDATOS INSCRITOS ZONA <? echo $zonaelectoral;?></h2>

					</td>
				</tr>

				<tr>
					<td><p><strong>
					Maximo de votos permitidos: <? echo $maximovotos;  ?>

					</strong></p></td>
				</tr>

				<tr>
					<td colspan=2>
					<?
					// LISTADO DE CANDIDATOS
						include("asociados_votaciones_listado.php");
					// FIN LISTADO DE CANDIDATOS
					?>
					</td>
				</tr>



				<?
				}
				?>


<?
	} else {
	// mensaje de inhabil
	?>
				<tr>

				<td ><p><? echo $dsm?></p></td>
				<td ><p><? echo $dsmensajeinhabil?></p></td>

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
	// mensaje de inhabil
?>
		<div class="line_contenidos"></div>

			<p>En estos momentos no se encuentran procesos de votaci&oacute;n activos</p>

<?

}
$result->Close();

?>