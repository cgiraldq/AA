<?
// carga de la ficha de postulacion
		$sql="select a.* from ";
		$sql.="tblvotacionfichatecnica a ";
		$sql.=" where idactivo=1 ";
		$sql.=" and idtv=$idtv";
		$sql.=" order by a.id asc  limit 0,1 ";

//echo $sql;
		
$idcandidato=$idcandidatox;					
$idasociado=$_SESSION['i_id'];
if ($idasociado=="") $idasociado=$_REQUEST['idasociado'];
$rutaxv="";
if ($regresar=="1") { 
$idcandidato=$idasociado;
}

$result=$db->Execute($sql);
	if (!$result->EOF) {	
?>
			
			<table style="width: 100%; border:1px #DDD solid; margin: 5px 0" cellpadding="3" cellspacing="3" border=0>
			
			<tr>
					<td colspan=2 align="center">
					
			 
					<a href="javascript:window.close();;" title="Click para cerrar"><div class="btn_formulario">Cerrar</div></a>
					
				
					</td>
				</tr>
	
			
			<form action="modulos/votaciones/asociados_votaciones_inscripciones.guardar.php" method="post" name="a" enctype="multipart/form-data" > 
			    	
			<?
			$idficha=$result->fields[0];

			$dsnombre=$result->fields[1];

			$encabezado=$result->fields[3];
			$pie=$result->fields[4];
			$txtficha=$result->fields[5];
			$txtficha=eregi_replace("\n","<br>",$txtficha);
							
?>

				<tr>
					<td bgcolor="#F6F6F6" colspan=2>zxzxzxzxzz<strong><? echo $txtficha?></strong>
<? echo "../contenidos/images/fichatecnica/".$encabezado;?>
					</td>
					
					
				</tr>
		<? 


		if (is_file("../contenidos/images/fichatecnica/".$encabezado)){?>	
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
					<td colspan=2 bgcolor="#F4F4F4">dsdssd<strong><? echo $i." ".$dsmpreg?></strong></td>
					
				</tr>
			<?
			if ($tipopreg==3) { 
				// validar existencia de datos
				 $sql4="select id,idasociado,idficha,idpreg,idresp,dsvalor from tblvotacionfichatecnicaasociados";
				 $sql4.=" where idasociado=$idcandidato and idficha=$idficha and idpreg=$idpreg  ";
						 
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
					while (!$resultprx->EOF) {
					$j++;
					
					//		Validar existencia
					
					$sql4="select id,idasociado,idficha,idpreg,idresp,dsvalor from tblvotacionfichatecnicaasociados";
					$sql4.=" where idasociado=$idcandidato and idficha=$idficha and idpreg=$idpreg ";
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
						$idresp=$resultprx->fields[0];
						$dsmresp=$resultprx->fields[1];
	
						 ?>
					<tr >
					<td align="left" colspan=2 >
				 <? if ($tipopreg=="1"){ ?>
				 <input name="idresp<? echo $idpreg;?>" type="radio" value="<? echo $idresp;?>" <?  echo $textov;?>>
				  <? }else if ($tipopreg==2){ ?>
				  <input name="idresp<? echo $idpreg;?>[]" type="checkbox" value="<? echo $idresp;?>" <?  echo $textov;?>>
				  <? } ?>
				  <span class="textodoc2"><? echo $dsmresp;?></span>
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
					<td colspan=2 align="center">
					
			 
					<a href="javascript:window.close();;" title="Click para cerrar"><div class="btn_formulario">Cerrar</div></a>
					
				
					</td>
				</tr>
	
	
	<? if (is_file("../contenidos/images/fichatecnica/".$pie)){?>	
	     <tr>
    <td colspan=2><img name="cbz2_1" src="../contenidos/images/fichatecnica/<? echo $pie; ?>" width="764"  border="0"></td>
     </tr>
   	<? } ?>

</form>
			</table>
<?
}
$result->Close();
//exit();
?>
