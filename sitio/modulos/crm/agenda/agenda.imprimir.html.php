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
 Impresion de pantalla
*/
//include ("../sessiones.php");
//include ("../../incluidos/creditos.php");
$rutx=1;
if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/funciones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario


?>
<html>
<head>
<title><? echo $AppNombre;?> Impresion Agenda Seleccionada</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<? include ($rutxx."../../incluidos_modulos/javageneral.php"); ?>
</head>
<body color=#ffffff  topmargin=5 leftmargin=0>
<div id="capa_impresion" align=center CLASS="TEXT1">


<a href="javascript:imprimir();">Imprimir</a> | <a href="javascript:window.close();">Cerrar Esta ventana</a>
</div>

<?
	//$db->debug=true;
	$tabla="crmtblvisitas";
	$idagenda=$_REQUEST['id'];

$sql="select idgestion,idmedio,dsfechai,dsfechaf,idusuario,idtipo,dshorai,dshoraf,idcliente,iddia,idcontacto,dsproducto,dsfechap,";
$sql.="idreportes,idplanos,idmateriales,dsresena,dsfactura,idreportes,idreportesmail,idplanos,idmateriales,dsobs,idra,idactivo ";
$sql.=",dshorap ";

$sql.=" from $tabla where id=".$idagenda;
//echo $sql;
	$result = $db->Execute($sql);
if (!$result->EOF) {

	$idgestion=$result->fields[0];
	$idrecepcion=$result->fields[1];
	$dsfechai=$result->fields[2];
	$dsfechar=$result->fields[3];
	$idusuario=$result->fields[4];
	$idtipo=$result->fields[5];
	$dshora1=$result->fields[6];
	// partir parametros
	$partir=explode(":",$dshora1);
	$dshorai=$partir[0];
	$dsmini=$partir[1];

	$dshora2=$result->fields[7];
	// partir parametros
	$partir=explode(":",$dshora2);
	$dshoraf=$partir[0];
	$dsminf=$partir[1];
	$idcliente=$result->fields[8];
	$iddia=$result->fields[9];
	$idcontacto=$result->fields[10];
	$dsproducto=$result->fields[11];
	$dsfechap=$result->fields[12];
	$dsreportes=$result->fields[13];
	$dsplanos=$result->fields[14];
	$idmateriales=$result->fields[15];
	$dsresena=$result->fields[16];
	$dsfactura=$result->fields[17];
	$idreportes=$result->fields[18];
	$idreportesmail=$result->fields[19];
	$idplanos=$result->fields[20];
	$idmateriales=$result->fields[21];
	$dsobs=$result->fields[22];
	$idra=$result->fields[23];
	$idactivo=$result->fields[24];
	$dshorap=$result->fields[25];

	}
	$result->Close();


?>
<table width="100%" border="0" class="textnegrotit">
	<tr>
		<td width="221px"><img src="../../../../contenidos/images/empresa/tblempresa1-085138-1.png"></td>
		<td align="center">
			GESTIONES DE AGENDAMIENTO<br>

		</td>
	</tr>
</table>
<table width="100%" border="0" class="text1">
	<tr>
		<td><strong>Gestion</strong><br>
			<?	$sql=" select dsnombre from crmtblgestiones where id='$idrecepcion'";
					$result = $db->Execute($sql);
						if (!$result->EOF) {
							echo $dsm=$result->fields[0];
						}
			?>
		</td>
		<td><strong>Forma de gesti&oacute;n:</strong><br>

			<?	$sql=" select dsnombre from  crmtblgestionesformas where id='$idgestion'";
					$result = $db->Execute($sql);
						if (!$result->EOF) {
							echo $dsm=$result->fields[0];
						}
			?>

		</td>
		<td><strong>Fecha de recepci&oacute;n:</strong><br>
		<? echo $dsfechar?>
		</td>

		<td><strong>Fecha de gestión:</strong><br>
		<? echo $dsfechai?>
		</td>
	</tr>
	<tr>
		<td><strong>Hora inicial:</strong><br>
		<? if($dshorai>12)echo ($dshorai-12).":".$dsmini." pm";
			else echo $dshorai.":".$dsmini." am";
		?>
		</td>
		<td><strong>Hora final:</strong><br>
		<? if($dshoraf>12)echo ($dshoraf-12).":".$dsminf." pm";
			else echo $dshoraf.":".$dsminf." am";
		?>
		</td>
		<td><strong>Total tiempo:</strong><br>
		<?
			$ini=((($dshorai*60)*60)+($dsmini*60));
			$fin=((($dshoraf*60)*60)+($dsminf*60));
			$dif=$fin-$ini;
			$difh=floor($dif/3600);
			$difm=floor(($dif-($difh*3600))/60);
			echo date("H:i",mktime($difh,$difm))." horas";
		?>
		</td>
	</tr>
	<tr>
	</tr>
</table>
<div style="height:10px"></div>
<table width="100%" border="0" class="text1" bgcolor="#FFFFFF">
	<tr bgcolor="#E9E9E9">
		<td align="center" colspan="5" style="padding:3px"><strong>INFORMACIÓN CLIENTE</strong></td>
	</tr>
	<?


		$sql="select a.nombre_o_razn_social, a.apellido_o_nombre_comercial, ";
		$sql.="telfono_1,telfono_2,correo_email,a.cdula_o_nit from ";
		$sql.=" crm_clientes a where a.id=$idcliente ";
		//$sql.=" crmtblclientescontacto b on a.id=b.idcliente and b.id=$idcontacto where a.id=$idcliente";
		//echo $sql;
		$result = $db->Execute($sql);
		if (!$result->EOF) {
			//$idcliente=$result->fields[0];
	?>
	<tr bgcolor="#E9E9E9" style="width:100%">
		<td><strong>Nombre y apellidos:</strong> <? echo $result->fields[0]." ".$result->fields[1];?></td>
		<td><strong>Identificaci&oacute;n:</strong> <? echo $result->fields[5];?></td>

		<td><strong>Telefono:</strong> <? echo $result->fields[2];?></td>
		<td><strong>Celular:</strong> <? echo $result->fields[3];?></td>
		<td><strong>Email:</strong> <? echo $result->fields[4];?></td>
	</tr>
	<?
		}
		$result->Close();
	?>
</table>
<div style="height:10px"></div>
<table width="100%" border="0" class="text1" bgcolor="#FFFFFF">
	<tr><td valign="top"><strong>Actividades:</strong></td></tr>
	<tr>

		<td colspan="3">
				<?
						$sql="select a.idtipo,a.id,a.dsm from crmtblactividades_roles a";
						if($_SESSION['i_idperfil']<>1)$sql.=", tblactividadesxroles b";
						$sql.="  where a.idactivo=1";
				     	if($_SESSION['i_idperfil']<>1)$sql.=" and a.id=b.idorigen and b.iddestino ='".$_SESSION['i_idrol']."' ";
						$sql.=" order by a.idtipo asc";
					//echo $sql;
					$result = $db->Execute($sql);
						if (!$result->EOF) {
				?>
					<table width="100%" class="text1" border="0">
						<tr>
						<?
							//$con=0;

							$contador=0;
							while(!$result->EOF) {
							if($idtipo<>$resultx->fields[0] && $idtipo<>""){
								//$con=0;

							}

							$chk="";
							if($idagenda<>""){
							$sqls="select id from crmtblvisitasxservicio where idvisita='$idagenda' and idservicio='".$result->fields[1]."';";
							//echo $sqls;
							$resultx = $db->Execute($sqls);
						if (!$resultx->EOF) {
								$chk="x";
							}
							$resultx->Close();
							}
						?>

						<? if($contador%2==0) echo "<tr>";?>
						<td  valign="top">
							<div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left;padding-bottom:0px">
								<? echo $chk?>
							</div>
							&nbsp;<? echo reemplazar($result->fields[2])?><? //echo $fila->idtipo?>
						</td>
						<?  if($contador%2==0) echo "</tr>";?>

						<?

							$result->MoveNext();
							$contador++;
							}


						?>
						</tr>
					</table>
				<?
					}
					$result->Close();
				?>
				</td>
	</tr>
</table>
<div style="height:10px"></div>
<table width="100%" border="0" class="text1">
	<!--tr>
		<td width="12%"><strong>Productos:</strong></td>
		<td><? echo $dsproducto;?></td>
	</tr-->
	<? if ($dsfechap<>"") {?>
		<tr>
		<td width="35%"><strong>Agendamiento próxima gesti&oacute;n:</strong></td>
		<td><?  echo $dsfechap. " hora: ".$dshorap;?></td>
	</tr>
	<? } ?>
	<!--tr>
		<td>
		<div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left">
		<? if($idreportes==1)echo "x";?></div>
		&nbsp;Reportes adjuntos (físicos)
		</td>
		<td><div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left">
		<? if($idreportesmail==1)echo "x";?></div>
		&nbsp;Reportes adjuntos (e-mail)
		</td>
		<td><div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left">
		<? if($idplanos==1)echo "x";?></div>
		&nbsp;Toma de planos
		</td>
		<td>
		<div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left">
		<? if($idmateriales==1)echo "x";?></div>
		&nbsp;Materiales
		</td>
	</tr-->
	<tr>
		<td colspan="4" align="left" style="padding:3px"><strong>OBSERVACIONES:</strong></td>
	</tr>
	<tr>
		<td colspan="4"><? echo $dsresena?></td>
	</tr>
</table>
<div style="height:10px"></div>
<?
	$sql="select dsnumero,dsactividad,dsresponsable,dsfechaini,dsfechafin from crmtblvisitasactividades where idvisita='$idagenda'";
	//echo $sql;
	$resultx = $db->Execute($sql);
if (!$resultx->EOF) {

?>

<table width="100%" bgcolor="#E4E4E4" cellspacing="1" class="text1">
	<tr>
		<td colspan="5" align="CENTER" style="padding:3px"><strong>COMPROMISOS:</strong></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td align="center"><strong>Nº</strong></td>
		<td align="center"><strong>COMPROMISOS O ACTIVIDADES</strong></td>
		<td align="center"><strong>RESPONSABLE</strong></td>
		<td align="center"><strong>FECHA INICIO</strong></td>
		<td align="center"><strong>FECHA ESTIMADA DE TERMINACIÓN</strong></td>
	</tr>
	<? 	while(!$resultx->EOF){
		if ($resultx->fields[0]<>""){
		?>
	<tr bgcolor="#FFFFFF">
		<td><? echo $resultx->fields[0]?></td>
		<td><? echo $resultx->fields[1]?></td>
		<td><? echo seldato("dsm","id","tblusuarios",$resultx->fields[2],1);?></td>
		<td align="center"><? echo $resultx->fields[3]?></td>
		<td align="center"><? echo $resultx->fields[4]?></td>
	</tr>
	<?
		}
	$resultx->MoveNext();
}
	?>
</table>
<?
	}
	$resultx->Close();?>

<div style="height:10px"></div>
<table width="100%" border="0" class="text1" cellspacing="2" cellpadding="10">
	<!--tr>
		<td width="25%">____________________________________</td>
		<td width="10%">&nbsp;</td>
		<td width="25%">____________________________________</td>
		<td width="10%">&nbsp;</td>
		<td width="25%">____________________________________</td>
	</tr-->
	<tr>
		<td width="25%">Nombre:______________________________</td>
		<td width="10%">&nbsp;</td>
		<td width="25%">Nombre:______________________________</td>
		<td width="10%">&nbsp;</td>
		<td width="25%">Nombre:______________________________</td>
	</tr>
	<tr>
		<td width="25%">Cargo:_______________________________</td>
		<td width="10%">&nbsp;</td>
		<td width="25%">Cargo:_______________________________</td>
		<td width="10%">&nbsp;</td>
		<td width="25%">Cargo:_______________________________</td>
	</tr>
	<tr>
		<td width="25%"><strong>Univiajes</strong></td>
		<td width="10%">&nbsp;</td>
		<td width="25%"><strong>Usuario</strong></td>
		<td width="10%">&nbsp;</td>
		<td width="25%"><strong>firma cliente</strong></td>
	</tr>
	<tr>
		<td colspan="5">
		Con su firma en este documento el cliente acepta lo contenido en él.
		</td>
	</tr>
</table>
<div style="height:10px"></div>
<table width="100%" border="0" class="text1">
	<!--tr>
		<td valign="top">Comentarios:</td>
		<td><? echo $dsobs?></td>
	</tr-->
</table>
<div style="height:10px"></div>
<table width="100%" border="0" class="text1">
	<tr>
		<td><strong>CALIFICACION GESTI&Oacute;N</strong></td>
		<td>
		<div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left"><? if($idra==1)echo "x";?></div>
		&nbsp;Excelente
		</td>
		<td>
		<div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left"><? if($idra==2)echo "x";?></div>
		&nbsp;Bueno
		</td>
		<td>
		<div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left"><? if($idra==3)echo "x";?></div>
		&nbsp;Regular
		</td>
		<td>
		<div style="width:10px;height:10px;border:1px black solid;text-align:center;float:left"><? if($idra==4)echo "x";?></div>
		&nbsp;Malo
		</td>

	</tr>
</table>
<br><br>
</body>
</html>
<script language="javascript">
<!--
function imprimir(){
	document.getElementById('capa_impresion').style.display='none';
	window.print();
}
//-->
</script>
