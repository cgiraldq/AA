<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
Include con datos para  mostrar
*/

$sql="select dsrango,dshorai,dshoraf,idcompromisos,idfechaanterior from crmtblagendamiento";

	$result = $db->Execute($sql);
	if (!$result->EOF) {

		$dsrango=$result->fields[0];
		$dshoraix=$result->fields[1];
		$dshorafx=$result->fields[2];
		$idcompromisos=$result->fields[3];
		$idfechaanterior=$result->fields[4];


	}
	$result->Close();

	if($dsrango<>""){
		$intervalo=$dsrango;
	}
	if($dshorai=="")$dshoraix=6;
	if($dshoraf=="")$dshorafx=23;



?>

<?/* $sql="select a.id,a.dsm from  tblusuarios a";
   if($_SESSION['i_idperfil']<>1){
   	$sql.=", tblusuarioxtblformularios b where a.id=b.iddestino and b.idorigen=".$_SESSION['i_idusuario'];
   }

   if($_SESSION['i_idperfil']==1) $sql.=" where a.idactivo=1";
	//echo $sql;
			$resultx=$db->Execute($sql);
   		if (!$resultx->EOF) {

		?>
		<tr>

			<td>Selecionar asesor:
				<select name="idusuario">
					<option> -- Selecionar -- </option>
					<? while (!$resultx->EOF) {
						$id=$resultx->fields[0];
						$dsm=reemplazar($resultx->fields[1]);

					?>
						<option value="<? echo $id;?>" <? if($id==$_REQUEST["idusuariox"]) echo "selected	";?>><? echo $dsm;?></option>
					<?
						$resultx->MoveNext();
					}?>



				</select>
			</td>
		</tr>

		<?

	}else{

	*/?>
		<input type="hidden" name="idusuario" value="<? if($_REQUEST['idusuariox']<>""){ echo $_REQUEST['idusuariox'];}else{echo $_SESSION['i_idusuario'];} ?>" >
	<?/*
	}
	$resultx->Close();
	*/?>

<tr align="center" valign="top">
				<td bgcolor="<? echo $fondos[4];?>" align="left">
					Gestion*
				</td>
				<td bgcolor="<? echo $fondos[4];?>" align="left">

					<? $sql="select id,dsnombre,idpos from crmtblgestiones where idactivo=1 order by dsnombre asc";
						//echo $sql;

					$result = $db->Execute($sql);
					if (!$result->EOF){

					?>
				<select name="idrecepcion" class="text1">
						<option value="">...</option>

						<? while(!$result->EOF){
							$id=$result->fields[0];
							$dsnombre=$result->fields[1];
							$idtipo=$result->fields[2];
							?>

						<option value="<? echo $id;?>" <? if($idrecepcion==$id){echo "selected";}?> >  <? echo $dsnombre;?> </option>

						<?
						$result->MoveNext();
						}
						?>
				</select>
				<?
					}
				$result->Close();
				?>
				</td>

				<td bgcolor="<? echo $fondos[4];?>" align="left">
					Forma de la gestion*
				</td>
				<td bgcolor="<? echo $fondos[4];?>" align="left">
					<? $sql="select id,dsnombre,idpos from crmtblgestionesformas where idactivo=1 order by dsnombre asc";
						//echo $sql;

					$result = $db->Execute($sql);
					if (!$result->EOF){

					?>
					<select name="idgestion" class="text1">
						<option value="">...</option>
						<? while(!$result->EOF){
							$id=$result->fields[0];
							$dsnombre=$result->fields[1];
							$idtipo=$result->fields[2];
							?>
						<option value="<? echo $id;?>" <? if($idgestion==$id){echo "selected";}?> > <? echo  $dsnombre;?> </option>
							<?
							$result->MoveNext();
							}
							?>

					</select>
					<?
					}
				$result->Close();
				?>
				</td>
</tr>

						<tr bgcolor="<? echo $fondos[4];?>" class="text1" >
							<td align="left">
							Calificaci&oacute;n gesti&oacute;n 
							</td>
							<td bgcolor="<? echo $fondos[4];?>" align="left">
							<select name="idra" class="text1">
							<option value="">...</option>
							<option value="1" <? if($idra==1)echo "selected";?>>Excelente</option>
							<option value="2" <? if($idra==2)echo "selected";?>>Bueno</option>
							<option value="3" <? if($idra==3)echo "selected";?>>Regular</option>
							<option value="4" <? if($idra==4)echo "selected";?>>Malo</option>
							</select>
							</td>
							<td>Estado de la gesti&oacute;n</td>
							<td >
							<select name="idactivo" class="text1">
							<option value="0" <? if($idactivo==0)echo "selected";?>>En proceso</option>
							<option value="1" <? if($idactivo==1)echo "selected";?>>Realizada</option>
							<option value="2" <? if($idactivo==2)echo "selected";?>>Cancelada</option>
							<option value="3" <? if($idactivo==3)echo "selected";?>>Anulada</option>
							</select>
							</td>
						</tr>


<tr bgcolor="<? echo $fondos[4];?>" >

	<td>Fecha gesti&oacute;n*</td>
	<td><? if ($dis=="") { ?>
		<img align="absmiddle" SRC="../../../images/fechas.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai', this,'','','','');" language="javaScript">
		<? } ?>
		<input readonly type="text" name="dsfechai" value="<? echo $dsfechai;?>" size=10 class="textnegro2">

	</td>


	<td><!--Fecha *:--></td>
	<td><? if ($dis=="") { ?>
		<!--img align="absmiddle" SRC="../../../images/fechas.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechar', this,'','','','');" language="javaScript"-->
		<? } ?>
		<input readonly type="hidden" name="dsfechar" value="<? echo $dsfechar;?>" >

	</td>

	</tr>


	<tr bgcolor="<? echo $fondos[4];?>">
	<td>Hora inicial*</td>
	<td>
		<? if ($dis<>""){?><input type="hidden" name="dshorai" value="<? echo $dshorai;?>"><? } ?>
		<select name="dshorai" class="text1" <? echo $dis;?>>
		<?
		for($i=$dshoraix;$i<$dshorafx;$i++){
		if ($i<10){
			$i1="0".$i;
		} else {
			$i1=$i;
		}
		?>
		<option value="<? echo $i1;?>" <? if ($i==$dshorai){ echo "selected";}?>><? echo $i1;?></option>
		<? } ?>
		</select>
		:
		<? if ($dis<>""){?><input type="hidden" name="dsmini" value="<? echo $dsmini;?>"><? } ?>
		<select name="dsmini" class="text1" <? echo $dis;?>>
		<?
		for($i=0;$i<=55;$i+=$intervalo){
		if ($i<10){
			$i1="0".$i;
		} else {
			$i1=$i;
		}
		?>
		<option value="<? echo $i1;?>" <? if ($i==$dsmini){ echo "selected";}?>><? echo $i1;?></option>
		<? } ?>
		</select>

	</td>

	<td>Hora final*</td>
	<td>
	<? if ($dis<>""){?><input type="hidden" name="dshoraf" value="<? echo $dshoraf;?>"><? } ?>
	<select name="dshoraf" class="text1" <? echo $dis;?>>
	<?
	for($i=$dshoraix;$i<$dshorafx;$i++){
	if ($i<10){
		$i1="0".$i;
	} else {
		$i1=$i;
	}
	?>
	<option value="<? echo $i1;?>" <? if ($i==$dshoraf){ echo "selected";}?>><? echo $i1;?></option>
	<? } ?>
	</select>
	:
	<? if ($dis<>""){?><input type="hidden" name="dsminf" value="<? echo $dsminf;?>"><? } ?>
	<select name="dsminf" class="text1" <? echo $dis;?>>
	<?
	for($i=0;$i<=55;$i+=$intervalo){
	if ($i<10){
		$i1="0".$i;
	} else {
		$i1=$i;
	}
	?>
	<option value="<? echo $i1;?>" <? if ($i==$dsminf){ echo "selected";}?>><? echo $i1;?></option>
	<? } ?>
	</select>

	</td>
</tr>




