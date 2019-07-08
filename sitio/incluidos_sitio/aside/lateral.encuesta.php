<?
	$sql="select a.id,a.dsm from tblencuesta a  ";
	$sql.=" where a.idactivo=1 order by rand() limit 0,1";
	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){
	$id=$result->fields[0];
	$dsm=$result->fields[1];
?>
<div class="encuesta_lateral">
	<h2>Danos tu opini&oacute;n</h2>
	<form name="encuesta" method="post">
	<input type="hidden" name="idencuesta" value="<? echo $id?>">
	<table align="center" style="width: 100%">
		<tr>
			<td colspan="2"><b><? echo reemplazar($dsm);?></b></td>
		</tr>
		<?
			$sqlr="select id,dsm from tblencuestarespuesta where idc=$id and idactivo=1 order by idpos desc";
			//echo $sqlr;
			$resultr=$db->Execute($sqlr);
			if(!$result->EOF){
			$con=1;
			while(!$resultr->EOF){
			$idr=$resultr->fields[0];

			$dsmr=$resultr->fields[1];
		?>
		<tr>
			<td><input name="idrespuesta" type="radio" value="<? echo $idr?>"  /></td>
			<td ><p><? echo $con?>. <? echo reemplazar($dsmr);?></p></td>
		</tr>
		<?
			$con++;
			$resultr->MoveNext();
			}
			}
		?>
		<tr>
			<td id="mensaje" colspan="2" class="validacion_encuesta"></td>
		</tr>
	</table>

	<table style="width: 100%">

		<tr>
			<td ><input type="button" class="btn_general"name="votar" value="Votar" onclick="encuestavotar()" ></td>
			<td><input type="button" class="btn_general"name="Resultados" value="Resultados" onclick="mostrarcapa('caparesul','verresult')"></td>

		</tr>
	</table>

	</form>


</div>

<?
	}
	$result->Close();
?>


<div id="caparesul" class="resultados_lateral" style="display:none;">
			<a name="targetresultados"></a>
		<table align="center" cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td tyle="height: 26px">
					<table align="center" style="width: 100%">
						<tr>
							<td>
							<h2>RESULTADOS</h2>
							</td>
							<td style="height: 25px" valign="top">
							<a href="javascript:cerrarcapa('caparesul','verresult')" id="cerrarresult">
								<img src="images/cerrar.jpg"onmouseover="this.src='images/cerrar_on.jpg'" onmouseout="this.src='images/cerrar.jpg'">
							</a>
							</td>
						</tr>
					</table>
					</td>
			</tr>
				<?
					$sql="SELECT sum(idhits) AS total FROM tblencuestarespuesta WHERE idc=$id";
					//echo $sql;
					$result=$db->Execute($sql);
					if(!$result->EOF){
					$totalencuesta=$result->fields[0];
					if ($totalencuesta=="") $totalencuesta=0;
					}
					// $result->Close();
					if ($totalencuesta>0){
					$sqlx="SELECT dsm,idhits ";
					$sqlx.="FROM tblencuestarespuesta ";
					$sqlx.="WHERE idc=$id ";
					$sqlx.="ORDER BY idpos DESC ";
					//echo $sqlx;
					$resultx=$db->Execute($sqlx);
					if(!$resultx->EOF)
				{
					$inc=0;
					while(!$resultx->EOF){
					$respuesta=$resultx->fields[0];
					$tema=reemplazar($resultx->fields[1]);
					$inc++;
					if ($inc>7)
				{
					$valor=7-$inc;
					if ($valor<0) $valor=0;
				} else {
					$valor=$inc;
				}
				    $valorx=$tema/$totalencuesta;
					$valorx=number_format($valorx*100,2);
					$ancho=$valorx;
					if ($ancho>100) $ancho=100;
				?>
				<tr>
					<td class="fondo_resultadoencuesta2">
						<table align="center" style="width: 93%; " cellpadding="0" cellspacing="0">
							<tr>
								<td >
								<h3><? echo $respuesta;?></h3></td>
								<td></td>
							</tr>
							<tr>
								<td style="width: 126px">
									<table align="left" style="width: 81%">
										<tr>
										<td>
											<img src="<? echo $rutalocal?>/images/puntaje<? echo $inc ?>.jpg" width="<? echo $ancho;?>" height="15">&nbsp;
										</td>
										</tr>
									</table>
								</td>
								<td><p><? echo $valorx;?>%</p></td>
							</tr>
						</table>
					</td>
				</tr>
				<?
				$resultx->MoveNext();
				} // fin while
				?>
			</table>
			<?
				}//fin

			} // fin $totalencuesta
			$resultx->Close();
			?>
	</div><!-- cierra resultado_encuesta -->




<script type="text/javascript">
	    function mostrarcapa(parametro,parametro2)
		{
			var contenedor1=document.getElementById(parametro);
			contenedor1.style.display ="";
			//var link=document.getElementById(parametro2);
			//link.style.display = "none";
		}

		function cerrarcapa(parametro,parametro2)
		{
			var contenedor1=document.getElementById(parametro);
			contenedor1.style.display = "none";
			//var link=document.getElementById(parametro2);
			//link.style.display = "";
		}

		function enviar()
		{
			document.frmencuesta.submit();
		}

		function abrir(tipo)
		{
		    capabase=document.getElementById('caparesul');

		     if (tipo==1)
		     {
		         capabase.style.display='';
		     }
		      else if (tipo==2)
		      {
		        capabase.style.display='none';
		      }
		}


		<? if ($_REQUEST['abrir']==1)
		   {
		    	?>
		    	abrir(1);
				<?
		   }
		?>
	</script>
