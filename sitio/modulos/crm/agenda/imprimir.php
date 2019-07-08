<?
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2011
Medellin - Colombia
=====================================================================
  Autores:  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
formato de imprimir la agenda
*/
$rutx=1;
if($rutx==1) $rutxx="../";
include ($rutxx."../../incluidos_modulos/sessiones.php");

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");

include ($rutxx."../../incluidos_modulos/funciones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
// validacion de existencia del modulo para este usuario
	$sql="select dsrango,dshorai,dshoraf from crmtblagendamiento where 1 ";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF){


		$dsrango=$result->fields[0];
		$dshoraix=$result->fields[1];
		$dshorafx=$result->fields[2];
	}
	if($dsrango<>""){
		$intervalo=$dsrango;
	}
	if($dshoraix=="")$dshoraix=6;
	if($dshorafx=="")$dshorafx=23;

	$dsfechax1=$_REQUEST['dsfechax1'];
	$idusuariox=$_REQUEST['idusuariox'];
	if ($idusuariox=="") $idusuariox=$_SESSION['i_idusuario'];
		$dia=$_REQUEST['iddia'];
		$mes=$_REQUEST['idmes'];
		$anio=$_REQUEST['idanio'];
	if ($dsfechax1<>"") {
		$partir=explode("/",$dsfechax1);
		$dia=intval($partir[2]);
		$mes=intval($partir[1]);
		$anio=intval($partir[0]);
	} elseif ($dia=="" && $mes=="" && $anio=="") {
		$dia=intval(date("d"));
		$mes=intval(date("m"));
		$anio=date("Y");
	} else {

	}
		if ($dia<10) $dia="0".$dia;
		if ($mes<10) $mes="0".$mes;
		$diabase=$anio."/".$mes."/".$dia;
		$idbase=$anio.$mes.$dia;

	// de acuerdo a esto capturar el ciclo y el dia del ciclo
	$sql="select a.id,a.dsm,a.dsfechai,a.dsfechaf";
	$sql.=",a.idcantidad,a.idanio";
	$sql.=" from ";
	$sql.=" crmtblciclos a ";
	$sql.=" where a.idactivo=1 ";
	$sql.=" and a.idanio=".$anio;
	$sql.=" and a.idempresa=".$_SESSION['i_idempresa'];
	$sql.=" and '$diabase' between a.dsfechai and a.dsfechaf";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF){

		$idciclo=$result->fields[0];
		$dsc=$result->fields[1];
		$dsfechai=$result->fields[2];
		// partir para calcular el año y el mes
		$partir=explode("/",$dsfechai);
		$mesbase=intval($partir[1]);
		$aniobase=$partir[0];
		$dsfechaf=$result->fields[3];
		$partir1=explode("/",$dsfechaf);
		$mesbase2=intval($partir1[1]);
		$aniobase2=$partir1[0];
		$idcantidad=$$result->fields[4];

		// traer el dia del ciclo
		$sql="select a.iddiaciclo from crmtblciclodiaxcal a, crmtblciclos b where ";
		$sql.=" a.idaniocal=".$anio;
		$sql.=" and a.iddiacal=".intval($dia);
		$sql.=" and a.idmescal=".intval($mes);
		$sql.=" and b.idempresa=".$_SESSION['i_idempresa'];
		$sql.=" and b.id=".$idciclo;
		$sql.=" and b.id=a.idciclo limit 0,1";
		//echo $sql;
		$resultx = $db->Execute($sql);
	if (!$resultx->EOF){
			$iddiaciclo=$result->fields[0];
		}
		$resultx->Close();




	 }
$result->Close();
	?>

	<html>
<head>
	<title><? echo $AppNombre;?>: Agenda</title>
<link rel="stylesheet" type="text/css" href="../../incluidos/estilos.css">
<? include ($rutxx."../../incluidos_modulos/javageneral.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>


			<table width="100%" cellspacing="2" cellpadding="1" class=text2 ID="Table2" bgcolor="<? echo $fondos[12];?>">
			<tr align="center" valign="top">
				<td align="center" valign="top" bgcolor="<? echo $fondos[3];?>" colspan="3" class="textnegrotit">
			<strong><? echo nombre_dia_semana_ciclo(numero_dia_semana(intval($dia),intval($mes),$anio))." ".intval($dia)." de ".nombre_mes(intval($mes))." de ".$anio.", ".$dsc;?></strong>
				</td>
			</tr>
			<tr align="center" valign="top" class="textnegro2" bgcolor="<? echo $fondos[12]?>">
<td align="center" valign="top" bgcolor="<? echo $fondos[4];?>" width="20%">Hora</td>
<td align="left" width="70%" valign="top" bgcolor="<? echo $fondos[4];?>">Actividad</td>
			</tr>


			<?
			$f=0;
			$inc=0;
			// $vector[$inc]=""; // constructor de vector por cada
			$xbase="";
			for ($h=$dshoraix;$h<$dshorafx;$h++) {
			if ($f%2==0) {
				$fondo=$fondos[5];
			} else {
				$fondo=$fondos[4];
			}
			$f++;


				if ($h<10) {
					$h1="0".$h;
				} else {
					$h1=$h;
				 }
			if ($h<12) {
				$int=" a.m";
				$hx=$h1;
			} elseif ($h==12) {
				$int=" m";
				$hx=$h1;
			} elseif ($h>=13) {
				$int=" p.m.";
				//$hx=($h-12);
				// if ($hx<10) $hx="0".$hx;
				$hx=$h1;
			}



				// otro partiendo en 3

				for ($m=0;$m<60;$m+=$intervalo) {
				$inc++;
					if ($m<10) {
						$m1="0".$m;
					} else {
						$m1=$m;
					}
					$idhorabasei=intval($h1.$m1);
					// hora base siguiente
					if ($m>=0 && $m<45) {
						$mx=(intval($m1)+$intervalo);
						$idhorabasef=intval($h1.$mx);
					} elseif ($m==45){
						$idhorabasef=intval(($h1+1)."00");
					} else {
						$idhorabasef=0;
					}

					$dshorabase=$h1.":".$m1;
					$dshorabasem=$hx.":".$m1;




				 $sqlf=" select a.id from framecf_tbltiposformularios a where idformclientes=1 ";
					$resultf = $db->Execute($sqlf);
					if (!$resultf->EOF) {
						$idform=$resultf->fields[0];
					}
					$resultf->Close();


				 $sqlc=" select a.dsm,a.dscampo from framecf_tbltiposformulariosxcampo a where idselect=1 and idtipoformulario=$idform order by id";
				 //echo $sqlc;
				 //exit();
					$resultc = $db->Execute($sqlc);
					if (!$resultc->EOF) {
						while(!$resultc->EOF) {

						$campodsm=$resultc->fields[0];
							$campo.="b.".$resultc->fields[1].",";

						$resultc->MoveNext();
					}
					}
					$resultc->Close();

					//echo $campo.="b.".$resultc->fields[1].",";
			 $campos = trim($campo,',');

			// vefificar que esta ocupado o disponible
			$sql="select a.id,a.idcliente,a.dshorai,a.dshoraf,a.idhorai,a.idhoraf,a.dsresena,";
			$sql.="a.idfecha,a.idtipo,a.dsproducto,a.idcotizar,$campos,b.id ";
			$sql.=" from crmtblvisitas a left join  crm_clientes b on a.idcliente=b.id ";

			$sql.="where ";

			$sql.=" a.dsfechai='$diabase'  ";
			if($_SESSION['i_idperfil']<>1) $sql.=" and (a.idusuario=".$_SESSION['i_idusuario']." or a.idusuario='".$_REQUEST['idusuariox']."')";
			if($_SESSION['i_idperfil']==1) $sql.=" and a.idusuario='".$_REQUEST['idusuariox']."'";

//		 echo $sql;

			$result = $db->Execute($sql);
			if (!$result->EOF) {
				$total=$result->RecordCount();
			// echo $total;
			$jj=0;

				while (!$result->EOF) {
				$jj++;
				$dsnombre=$result->fields[11]." ".$result->fields[12]." ".$result->fields[13];
				$horai=$result->fields[4];
				$horaf=$result->fields[5];
				$dshorai=$result->fields[2];
				$dshoraf=$result->fields[3];
				$dsobs=$result->fields[6];
				if($dsobs<>""){ $dsobs= "Comentarios: ".$dsobs;}
				$iddetalle=$result->fields[0];
				// echo $horai."-".$horaf."<br>";


					if ($idhorabasei>=$horai && $idhorabasei<$horaf) {
						$base="Cliente: $dsnombre";
						$basej="Cliente: $dsnombre<br>$dsobs<br>($dshorai-$dshoraf)";
						$xbase.="Cliente: $dsnombre";
						$color=$fondos[3];
						?>
						<? if ($base==$xbase) {?>
						<tr align="center" valign="top" bgcolor="<? echo $color;?>">
						<td align="center" valign="top"><? echo $dshorabasem. " ".$int;?></td>
						<td align="left" valign="top"><? if ($base==$xbase)  echo $basej;?></td>
						</tr>
						<? 	}?>
						<?
						break 1;
					} elseif ($idhorabasei<$horai) {
					?>
					<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="center" valign="top"><? echo $dshorabasem. " ".$int;?></td>
					<td align="left" valign="top"><? // echo  $dsnombre;?></td>
					</tr>
					<?
					$xbase="";
					break 1;
					} elseif ($idhorabasei==$horai) {
					?>
					<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="center" valign="top"><? echo $dshorabasem. " ".$int;?></td>
					<td align="left" valign="top"><? // echo  $dsnombre;?></td>
					</tr>
					<?
					$xbase="";
					} elseif ($idhorabasei==$horaf) {
						// PENDIENTE

						?>
					<!--tr align="center" valign="top" bgcolor="<? //echo $fondo;?>">
					<td align="center" valign="top"><? //echo $dshorabasem. " ".$int;?></td>
					<td align="left" valign="top"><? // echo  $dsnombre;?></td>
					</tr -->
						<?
					$xbase="";
					break;
					} elseif ($idhorabasei>$horaf && $jj>=$total) {
					?>
					<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="center" valign="top"><? echo $dshorabasem. " ".$int;?></td>
					<td align="left" valign="top"><? // echo  $dsnombre;?></td>
					</tr>
					<?
					$xbase="";
					}
			//	if ($jj<$total) $xbase="";
					$result->MoveNext();
			}  //FIN WHILE

			} else {
				// no hay datos que muestre todo el sistema
					?>
					<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="center" valign="top"><? echo $dshorabasem. " ".$int;?></td>
					<td align="left" valign="top"><? // echo $dsnombre;?></td>
					</tr>
					<?

			} // fin si affected_rows

			$result->Close();

			 } // fin for interno

			}
			?>


				<tr align="center" valign="top">
				<td align="center" width="$intervalo%" valign="top" bgcolor="<? echo $fondos[4];?>" class="formabot"></td>
				<td align="center" width="70%" valign="top" bgcolor="<? echo $fondos[4];?>" class="formabot"></td>
			</tr>
			</table>
	<br>
<?
//include ("../../incluidos/cerrarconexion.php");
?>
</body>
</html>
<script language="javascript">
<!--
window.print();
//-->
</script>

