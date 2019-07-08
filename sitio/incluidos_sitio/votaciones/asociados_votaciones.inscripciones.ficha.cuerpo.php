<?
// carga de la ficha de postulacion
		$sql="select a.* from ";
		$sql.="tblvotacionfichatecnica a ";
		$sql.=" where idactivo=1 ";
		$sql.=" and idtv=$idtv";
		$sql.=" order by a.id asc  limit 0,1 ";

//echo $sql;

$idcandidato=$_REQUEST['idcandidato'];
$regresar=$_REQUEST['regresar'];

if ($idcandidato=="" && $regresar=="") $idcandidato=0;
$idasociado=$_SESSION['i_id'];
if ($idasociado=="") $idasociado=$_REQUEST['idasociado'];
$rutaxv="";
if ($regresar=="1") {
$idcandidato=$idasociado;
$rutaxv="../../";
}

$result=$db->Execute($sql);
	if (!$result->EOF) {
?>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
			<form action="modulos/validaciones/asociados_votaciones_inscripciones.guardar.php" method="post" name="a" enctype="multipart/form-data" >

			<?
			$idficha=$result->fields[0];

			$dsnombre=$result->fields[1];

			$encabezado=$result->fields[3];
			$pie=$result->fields[4];
			$txtficha=$result->fields[5];
			$txtficha=eregi_replace("\n","<br>",$txtficha);

?>

				<tr>
					<td bgcolor="#F6F6F6" colspan=2><strong><? echo $txtficha?></strong></td>
				</tr>


					<? if (is_file("../contenidos/images/fichatecnica/".$encabezado)){?>
					     <tr>
				    <td colspan=2><img name="cbz2_1" src="../contenidos/images/fichatecnica/<? echo $encabezado; ?>" width="764"  border="0"></td>
				     </tr>
				   	<? } ?>



			<?
			// MANEJO DE PREGUNTAS
			$sqlpr=" select id,dsm,idtipo from  tblvotacionfichatecnicapreguntas ";
			$sqlpr.=" where idficha=$idficha and idtv=$idtv order by idpos ASC";
			//echo $sql;

			$resultpr=$db->Execute($sqlpr);
			if (!$resultpr->EOF) {
				$i=0;
				while (!$resultpr->EOF) {
				$i++;
					$idpreg=$resultpr->fields[0];
					$dsmpreg=$resultpr->fields[1];
					$tipopreg=$resultpr->fields[2];


			?>
				<tr>
					<td colspan=2 ><p><? echo $i." ".$dsmpreg?></p></td>
				</tr>
			<?
			$textov="";
			if ($tipopreg==3) {
				// validar existencia de datos
				 $sql4="select id,idasociado,idficha,idpreg,idresp,dsvalor from tblvotacionfichatecnicaasociados";
				 $sql4.=" where idasociado=$idcandidato and idficha=$idficha and idpreg=$idpreg ";

						// echo $sql4;
						 //exit();
						$resultv=$db->Execute($sql4);
						if (!$resultv->EOF) {
							$textov=$resultv->fields[5];
  		                 }else{
		                  $textov="";
	                     }

	                     $resultv->Close();
					?>
				<tr>
				  <td colspan="2">
				     <textarea cols="80" rows="11" name="idresp<? echo $idpreg;?>"><? echo $textov; ?></textarea>
				 </td>
			    </tr>
					<?

			} else {

				$sql2=" select id,dsm from tblvotacionfichatecnicarespuestas  ";
				$sql2.=" where idpregunta=$idpreg order by idpos ASC";

				//echo $sql2;

				$resultprx=$db->Execute($sql2);
				if (!$resultprx->EOF) {
					$j=0;
					$textov="";

					while (!$resultprx->EOF) {
					$j++;

					//		Validar existencia
					$idresp=$resultprx->fields[0];
					$dsmresp=$resultprx->fields[1];

					$sql4="select id,idasociado,idficha,idpreg,idresp,dsvalor from tblvotacionfichatecnicaasociados";
					$sql4.=" where idasociado=$idcandidato and idficha=$idficha and idpreg=$idpreg and idresp=$idresp ";
					//echo $sql4;
						// echo $sql4;
						 //exit();
						$resultv=$db->Execute($sql4);
						if (!$resultv->EOF) {
							$textov="checked";
  		                 }else{
		                  $textov="";
	                     }

	                     $resultv->Close();

						 ?>
					<tr >
					<td align="left" colspan=2 >
				 		<? if ($tipopreg=="1"){ ?>
						 <input name="idresp<? echo $idpreg;?>" type="radio" value="<? echo $idresp;?>" <?  echo $textov;?>>
				  		<? }else if ($tipopreg==2){ ?>
				  		<input name="idresp<? echo $idpreg;?>[]" type="checkbox" value="<? echo $idresp;?>" <?  echo $textov;?>>
				  <? } ?>
				  		<p><? echo $dsmresp;?></p>
				  </td>
				 </tr>
				<?

					$resultprx->MoveNext();

					}

				}
				$resultprx->Close();

			} // fin tipo de pre3g


			// RESPUESTAS
				$resultpr->MoveNext();

			}


			}
			$resultpr->Close();


			// FIN RESPUESTAS


			// FIN PREGUNTAS

			?>



			<tr>
                   <td class=""><p>Foto</p></td>
                   <td>
				   <input name="userfile" type="file" class="forma">
				   <? if ($foto<>"") { ?>
				   <input type=hidden name=foto value="<? echo $foto?>">
				   <p><? echo $foto?></p>
				   <? } ?>
				   </td>
                 </tr>

              <tr>
                <td align="left" colspan=2><div align="justify">
               	<p><strong>   Asociado:</strong> Para cargar la imagen, Por favor  presione el boton examinar y seleccione la imagen que desea cargar.</p>
                </div></td>
              </tr>



				<tr>
					<td colspan=2 align="center">
					<?
					if ($regresar=="1") {
					?>
					<a href="javascript:val();" title="Click para postularse"class="btn_color"><p>Ingresar</p></a>

					<input type=hidden name=idficha value="<? echo $idficha;?>">
					<input type=hidden name=idtv value="<? echo $idtv;?>">
					<input type=hidden name=dstv value="<? echo $dstv;?>">
					<input type=hidden name=idx value="<? echo $idx;?>">
					<input type=hidden name=dsx value="<? echo $dsx;?>">
					<input type=hidden name=idy value="<? echo $idy;?>">
					<input type=hidden name=dsy value="<? echo $dsy;?>">
					<input type=hidden name=idasociado value="<? echo $idasociado;?>">
					<input type=hidden name=regresar value="<? echo $regresar;?>">

					<?
					} elseif($textov=="" && $idcandidato==""){ ?>

					<a href="javascript:val();" title="Click para postularse"class="btn_color"><p>Ingresar</p></a>

					<input type=hidden name=idficha value="<? echo $idficha;?>">
					<input type=hidden name=idtv value="<? echo $idtv;?>">
					<input type=hidden name=dstv value="<? echo $dstv;?>">
					<input type=hidden name=idx value="<? echo $idx;?>">
					<input type=hidden name=dsx value="<? echo $dsx;?>">
					<input type=hidden name=idy value="<? echo $idy;?>">
					<input type=hidden name=dsy value="<? echo $dsy;?>">

					<? } else {?>
					<a href="asociados_votaciones.php?idy=<? echo $idy?>&dsy=<? echo $dsy?>&idx=<? echo $idx?>&dsx=<? echo $dsx?>" title="Click para postularse">
						<div class="btn_formulario">Ingresar</div></a>

<? } ?>
					</td>
				</tr>


	<? if (is_file("../contenidos/images/fichatecnica/".$pie)){?>
	     <tr>
    <td colspan=2><img name="cbz2_1" src="../contenidos/images/fichatecnica/<? echo $pie; ?>" width="764"  border="0"></td>
     </tr>
   	<? } ?>

</form>
</table>


</td>
</tr>
</table>
<?
}
$result->Close();
//exit();
?>

<script language="javascript">
<!--

function val(){

			<?
			//exit();
			$sqlpr=" select id,dsm,idtipo,idoblig from  tblvotacionfichatecnicapreguntas ";
			$sqlpr.=" where idficha=$idficha and idtv=$idtv order by idpos ASC";

			//echo $sqlpr;
			//exit();
			$resultpr=$db->Execute($sqlpr);
			if (!$resultpr->EOF) {
				while (!$resultpr->EOF) {
				//exit();
					$idpreg=$resultpr->fields[0];
					$preg=$resultpr->fields[1];
					$tipo=$resultpr->fields[2];
					$obligatorio=$resultpr->fields[3];


			if ($obligatorio=="1"){
					   if ($tipo==3){// tipo texto
					?>
						if (document.a.idresp<? echo $idpreg;?>.value=="") {
							 alert("Por favor ingrese la respuesta en <? echo $preg;?>");
							 document.a.idresp<? echo $idpreg;?>.focus();
							 return;
					   }
					<? } elseif ($tipo==1) { // radiobutton?>
						acum=0;
						for (i=0;i<document.a.idresp<? echo $idpreg;?>.length;i++) {
							if (document.a.idresp<? echo $idpreg;?>[i].checked) {
							acum=acum+1;
						}
					}

						if (acum<1) {
						alert("Debe responder <? echo $preg;?> ");
						return;
						}

					<? } elseif ($tipo==2) { // checkbox?>

					cantidad=document.a['idresp<? echo $idpreg;?>[]'].length;
					acum=0;
					for (i = 0; i < cantidad; i++){
					if(document.a['idresp<? echo $idpreg;?>[]'][i].checked == true) {
						acum++;
						}
					}


					if (acum<1) {
					alert("Debe responder <? echo $preg;?> ");
					return;
					}
					<?
				} // fin si
			} // fion obligatorio?>


			<?
			//exit();
					$resultpr->MoveNext();

					}

				}
				$resultpr->Close();

			?>
			document.a.target='_self';
			document.a.action='<? echo $rutaxv?>modulos/validaciones/asociados_votaciones_inscripciones.guardar.php';
			document.a.submit();


}

//-->
</script>


