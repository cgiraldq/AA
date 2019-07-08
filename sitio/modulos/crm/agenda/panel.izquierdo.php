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
Listado de las horas de un dia de acuerdo al dia pedido o el actual
*/
// validacion de existencia del modulo para este usuario
//$db->debug=true;
	$sql="select dsrango2,dshorai,dshoraf from crmtblagendamiento";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dsrango=$result->fields[0];
		$dshoraix=$result->fields[1];
		$dshorafx=$result->fields[2];
	}
	$result->Close();

	if($dsrango<>""){
		$intervalo=$dsrango;
	}
	if($dshoraix=="")$dshoraix=6;
	if($dshorafx=="")$dshorafx=23;

	$dsfechax1=$_REQUEST['dsfechax1'];
	$idusuariox=$_REQUEST['idusuariox'];
	if ($idusuariox=="") $idusuariox=$_SESSION['i_idusuario'];

	if($_REQUEST['idusuario']<>'') $idusuariox=$_REQUEST['idusuario'];

	

		$dia=$_REQUEST['iddia'];
		$mes=$_REQUEST['idmes'];
		$anio=$_REQUEST['idanio'];
	if ($dsfechax1<>"") {
		$partir=explode("/",$dsfechax1);
		$dia=intval($partir[2]);
		$mes=intval($partir[1]);
		$anio=intval($partir[0]);
	} elseif ($dsfechax<>""){
		$partir=explode("/",$dsfechax);
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

	$sql.=" and '$diabase' between a.dsfechai and a.dsfechaf";
//echo $sql;
	$resultx = $db->Execute($sql);
	if (!$resultx->EOF) {

		$idciclo=$resultx->fields[0];
		$dsc=$resultx->fields[1];
		$dsfechai=$resultx->fields[2];
		// partir para calcular el año y el mes
		$partir=explode("/",$dsfechai);
		$mesbase=intval($partir[1]);
		$aniobase=$partir[0];
		$dsfechaf=$resultx->fields[3];
		$partir1=explode("/",$dsfechaf);
		$mesbase2=intval($partir1[1]);
		$aniobase2=$partir1[0];
		$idcantidad=$resultx->fields[4];


		// traer el dia del ciclo
		$sql="select a.iddiaciclo from crmtblciclodiaxcal a, crmtblciclos b where ";
		$sql.=" a.idaniocal=".$anio;
		$sql.=" and a.iddiacal=".intval($dia);
		$sql.=" and a.idmescal=".intval($mes);

		$sql.=" and b.id=".$idciclo;
		//$sql.=" and b.id=a.idciclo limit 0,1";
		//echo $sql;
		$result = $db->Execute($sql);
	if (!$result->EOF) {
	$iddiaciclo=$result->fields[0];

		}
		$result->Close();



	 }
	$resultx->Close();
	?>
<table width="90%" cellspacing="2" border="0" cellpadding="1" ID="Table2" bgcolor="<? echo $fondos[3];?>" class="cont_crm_agendamiento_listado">
	<form method="post" name="agenda" action="<? echo $pagina;?>">
		<tr align="center" valign="top">
			<td align="center" valign="top"  colspan="3">
				<h2><? echo reemplazar(nombre_dia_semana_ciclo(numero_dia_semana(intval($dia),intval($mes),$anio)))." ".intval($dia)." de ".nombre_mes(intval($mes))." de ".$anio.", ".$dsc;?></h2>

			<?
			if ($_SESSION['i_idagenda']==1 || $_SESSION['i_idperfil']==0) {
				// include("../../incluidos/listar.usuarios.ciclos.php");
			} else {
				?>
			<input type="hidden" name="idusuariox" value="<? echo $idusuariox;?>">
			<input type="hidden" name="enca" value="<? echo $enca;?>">
				<?
			}
			?>

			<!--input readonly type="text" name="dsfechax1" value="<? echo $diabase;?>" class=formabot1 size=10>
				<img align="absmiddle" SRC="../../../images/fechas.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechax1', this,'agenda',1,'','');" language="javaScript">
			<input type="submit" name="enviar" value="VER"-->

			<!--a href="../vendedor/detallerutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>" title="Click para ingresar actividad">Hacia el rutero</a-->
			<input type="button" class="botones" value="Enviar Actividades para este d&iacute;a" onClick="irAPaginaDN('../agenda/enviar.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&rr=&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>');">

			<input type="button" class="botones" value="Imprimir Actividades para este d&iacute;a" onClick="irAPaginaDN('../agenda/imprimir.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&rr=&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>');">
			<input type="submit" name="Agendamiento" class="botones" value="Regresar">
			<input type="hidden" name="idgestion" value="<? echo $_REQUEST['idgestion'];?>">
			</td>
		</tr>

		<tr align="center" valign="top" class="crm_agendamiento_listado_cbz">
			<td align="center" valign="top" bgcolor="<? echo $fondos[4];?>" class="formabot" width="20%">Hora</td>
			<td align="left" width="70%" valign="top" bgcolor="<? echo $fondos[4];?>" class="formabot">Actividad</td>
			<td align="center" valign="top" bgcolor="<? echo $fondos[4];?>" class="formabot">Opciones</td>
		</tr>

			<?
			$f=0;
			$inc=0;
			// $vector[$inc]=""; // constructor de vector por cada
			$xbase="";
			for ($h=$dshoraix;$h<$dshorafx;$h++) {
			//echo $h;
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





				 $sqlf=" select a.id from framecf_tbltiposformularios a where idformclientes=1";
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
			$sql="select a.id,a.idcliente,a.dshorai,a.dshoraf,a.idhorai,a.idhoraf,a.dsobs,";
			$sql.="a.idfecha,a.idtipo,a.dsproducto,a.idcotizar ";
			if($campos<>"")$sql.=" ,$campos ";
			$sql.=",b.id ";
			$sql.=", a.dsresena " ;
			$sql.=" from crmtblvisitas a left join  crm_clientes b on a.idcliente=b.id ";

			$sql.="where ";

			$sql.=" a.dsfechai='$diabase' ";

			if($_SESSION['i_idperfil']<>1)$sql.="and (a.idusuario=".$_SESSION['i_idusuario']." or a.idusuario='".$_REQUEST['idusuario']."');";

			if($_SESSION['i_idperfil']==1)$sql.="and a.idusuario='".$_REQUEST['idusuario']."';";
			$result = $db->Execute($sql);
			if (!$result->EOF) {
			$total=$result->RecordCount();
			// echo $total;
			$jj=0;

				while(!$result->EOF) {
				$jj++;
				$dsnombre=$result->fields[11];
				if ($result->fields[12]<>"" && $result->fields[12]<>"na") $dsnombre.=" ".$result->fields[12];
				if ($result->fields[13]<>"" && $result->fields[13]<>"na") $dsnombre.=" ".$result->fields[13];
				if ($result->fields[14]<>"" && $result->fields[14]<>"na") $dsnombre.=" ".$result->fields[14];

				//if($result->fields[1]==0) echo $dsnombre="Actividad administrativa";
				//if ($dsnombre=="") $dsnombre="Actividad administrativa";
				//$dsnombre="Actividad administrativa";
				$horai=$result->fields[4];
				$horaf=$result->fields[5];
				$dshorai=$result->fields[2];
				$dshoraf=$result->fields[3];
				$dsobs=$result->fields[6];
				if ($dsobs=="na") $dsobs="";
				$iddetalle=$result->fields[0];


				 //echo $idhorabasei." -- ". $horai."-".$idhorabasei." -- ".$horaf."<br>";
					if ($idhorabasei>=$horai && $idhorabasei<$horaf) {
						$base="Cliente: $dsnombre";
						$basej="Cliente: $dsnombre\n$dsobs\n($dshorai-$dshoraf)";
						$xbase.="Cliente: $dsnombre";
						$color=$fondos[9];
						?>
						<? if ($base==$xbase) {?>
<tr align="center" valign="top" bgcolor="<? echo $color;?>" title="<? echo $basej;?>">
	<td align="left" valign="top"> <? if ($iddetalle >=$fechaBaseNum){ ?>
		<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>
			&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>
			&dataciclo=<? echo $iddiacal;?>&opt=1&mod=1&iddetalle=<? echo $iddetalle;?>&rr=<? echo $rutabase;?>
			&dsfechax1=<? echo $diabase;?>&idusuariox=<? echo $idusuariox;?>&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>');"
			title="Click si desea modificar toda la información de la visita seleccionada"><? } ?>
			<? echo $dshorabasem. " ".$int;?> <? if ($result->fields[7]>=$fechaBaseNum){ ?></a><? } ?>
	</td>

	<td align="left" valign="top">
		<? if ($base==$xbase)  echo $basej;?>
	</td>

	<td align="center" valign="top">
	<? //echo $idbase."/".$fechaBaseNum;
	if($fechaBaseNum<=$idbase){?>	<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>
			&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>
			&opt=1&mod=1&iddetalle=<? echo $iddetalle;?>&rr=<? echo $rutabase;?>&dsfechax1=<? echo $diabase;?>
			&idusuariox=<? echo $idusuariox;?>&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>');"
			 title="Click si desea modificar toda la información de la gesti&oacute;n seleccionada"
		<? //if ($fila->idfecha>=$fechaBaseNum){ ?>
		<img src="../../temas/tipoarchivos/psd.gif" align="absmiddle" border="0"
		alt="Click si desea modificar toda la información de la visita seleccionada">
		<? //} ?>
		Editar</a><?}?>

	<a href="javascript:irAPaginaDN('../agenda/agenda.imprimir.html.php?id=<? echo $result->fields[0];?>')"
		type="imprimir">imp
	</a>

	<a href="../formularios/formularios.vistaprevia.php?idx=50&cliente_asociado=<? echo $result->fields[1]; ?>&obs=<? echo $result->fields['dsresena']; ?>&asesor_operativo=<? echo $_SESSION['i_idusuario']; ?>">Cotizar</a>
	</td>
</tr>
						<? 	}?>
						<?
						break 1;
					} elseif ($idhorabasei<$horai) {
					?>
				<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="left" valign="top">
						<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=
						<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=
						<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&agenda=1&opt=1&dsfechax1=
						<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=
						<? echo $idusuariox;?>&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>','','');" 						title="Click para ingresar actividad"><? echo $dshorabasem. " ".$int;?>
						</a>
					</td>

					<td align="left" valign="top"><!--Antes--><? // echo $horai;?></td>
					<td align="center" valign="top">
						<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=
						<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=
						<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=
						<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>
						&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>','','');" title="Click para ingresar actividad">
						<img src="../../../images/txt.gif" align="absmiddle" border="0" alt="Click para ingresar actividad">
					</a>
					</td>
				</tr>
					<?
					$xbase="";
					break;

					} elseif ($idhorabasei==$horai) {
					?>
					<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="left" valign="top"><a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>','','');" title="Click para ingresar actividad"><? echo $dshorabasem. " ".$int;?></a></td>
					<td align="left" valign="top"><? // echo  $dsnombre;?></td>
					<td align="center" valign="top"><a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>','','');" title="Click para ingresar actividad">
						<img src="../../../images/txt.gif" align="absmiddle" border="0" alt="Click para ingresar actividad"></td>
					</tr>
					<?
					$xbase="";
					} elseif ($idhorabasei==$horaf ) {// PENDIENTE?>
					<!--tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="left" valign="top">
						<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>
							&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>
							&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>
							&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&agenda=1
							&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>','','');" title="Click para ingresar actividad">
							<? echo $dshorabasem. " ".$int;?>123
						</a>
					</td>

					<td align="left" valign="top"><? // echo  $dsnombre;?></td>
					<td align="center" valign="top"><a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&agenda=1','','');" title="Click para ingresar actividad">
						<img src="../../images/txt.gif" align="absmiddle" border="0" alt="Click para ingresar actividad"></td>
					</tr -->
						<?
					$xbase="";
					break;

					} elseif ($idhorabasei>=$horaf && $jj>=$total) {
					?>
					<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
					<td align="left" valign="top">
						<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>
							&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>
							&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>
							&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>
							&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>','','');" 							title="Click para ingresar actividad">
							<? echo $dshorabasem. " ".$int;?>
						</a>
					</td>

					<td align="left" valign="top"><? // echo  $dsnombre;?></td>
					<td align="center" valign="top"><a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>','','');" title="Click para ingresar actividad">
						<img src="../../../images/txt.gif" align="absmiddle" border="0" alt="Click para ingresar actividad"></td>
					</tr>
					<?
					$xbase="";
					}
			//	if ($jj<$total) $xbase="";
					$result->MoveNext(); //FIN WHILE
			}


			} else {
				// no hay datos que muestre todo el sistema
					?>
					<tr align="center" valign="top" bgcolor="<? echo $fondo;?>">
						<td align="left" valign="top">
							<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>
								&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>
								&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>
								&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>
								&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>','','');" 								title="Click para ingresar actividad">
								<? echo $dshorabasem. " ".$int;?>
							</a>
						</td>

					<td align="left" valign="top"><? // echo $dsnombre;?></td>

					<td align="center" valign="top">
						<a href="javascript:irAPaginaDN('../vendedor/procesosrutero.php?idciclo=<? echo $idciclo;?>
							&dsciclo=<? echo $dsc;?>&diaciclo=<? echo $iddiaciclo;?>&totalciclo=<? echo $idcantidad;?>
							&dataciclo=<? echo $iddiacal;?>&opt=1&dsfechax1=<? echo $diabase;?>&hi=<? echo $h1?>
							&mi=<? echo $m1?>&rr=<? echo $rutabase;?>&idusuariox=<? echo $idusuariox;?>
							&agenda=1&idgestionx=<? echo $_REQUEST['idgestion'];?>&enca=<? echo $enca;?>&idcliente=<? echo $_REQUEST['idcliente'];?>','','');" 							title="Click para ingresar actividad">
						<img src="../../../images/txt.gif" align="absmiddle" border="0" alt="Click para ingresar actividad">
					</td>
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
				<td align="center" valign="top" bgcolor="<? echo $fondos[4];?>" class="formabot">&nbsp;</td>
			</tr>
			</form>
			</table>
			<table width="50%" align="center" class="crm_agendamiento_remate">
				<tr>
					<td><p>En proceso</p></td>
					<td>
					<?
						$sql="select count(*) as total from crmtblvisitas a, crm_clientes b ";
						//$sql.=" where a.idusuario=".$idusuariox;
						$sql.=" where a.dsfechai='$diabase' and a.idactivo in (0) and a.idcliente=b.id group by a.idactivo ";
						//echo $sql;
						$result = $db->Execute($sql);
							if (!$result->EOF) {
							 $total=$result->fields[0];
							 echo $total;

						}else{
							echo "0";
						}
						$result->Close();
					?>
					</td>
				</tr>
				<tr style="color:#000000">
					<td><p>Realizada</p></td>
					<td>
					<?
						$sql="select count(*) as total from crmtblvisitas a, crm_clientes b ";
						//$sql.=" where a.idusuario=".$idusuariox;
						$sql.=" where a.dsfechai='$diabase' and a.idactivo in (1) and a.idcliente=b.id group by a.idactivo ";
						$result = $db->Execute($sql);
							if (!$result->EOF) {
							echo $total=$result->fields[0];
						}else{
							 echo "0";
						}
						$result->Close();
					?>
					</td>
				</tr>
				<tr style="color:#000000">
					<td><p>Cancelada</p></td>
					<td>
					<?
						$sql="select count(*) as total from crmtblvisitas a, crm_clientes b ";
						//$sql.=" where a.idusuario=".$idusuariox;
						$sql.=" where a.dsfechai='$diabase' and a.idactivo in (2) and a.idcliente=b.id group by a.idactivo ";
						$result = $db->Execute($sql);
							if (!$result->EOF) {
							echo $total=$result->fields[0];
						}else{
							echo "0";
						}
						$result->Close();
					?>
					</td>
				</tr>
				<tr style="color:#000000">
					<td><p>Anulada</p></td>
					<td>
					<?
						$sql="select count(*) as total from crmtblvisitas a, crm_clientes b ";
						//$sql.=" where a.idusuario=".$idusuariox;
						$sql.=" where a.dsfechai='$diabase' and a.idactivo in (3) and a.idcliente=b.id group by a.idactivo ";
						$result = $db->Execute($sql);
							if (!$result->EOF) {
							echo $total=$result->fields[0];
						}else{
							echo "0";
						}
					?>
					</td>
				</tr>

			</table>
