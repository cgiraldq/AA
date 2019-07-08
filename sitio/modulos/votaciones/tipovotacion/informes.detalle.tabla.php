<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// Tabla central de datos cuando se hacen los listados
?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<tr>
<?
// encabezado generico basado 
$nombrecampos="Consecutivo,Zona electoral,Codigo Asociado,Nombre Asociado,Fecha de registro,Numero de votos";
 if ($grafica=="1") $nombrecampos.=",Porcentaje";
 $partir=explode(",",$nombrecampos);
	  $total=count($partir);



	  for ($i=0;$i<$total;$i++) { 
?>
 <td align="center"  class="text1">
	  <? echo $partir[$i];?>
		</td>
<?
}
?>
</tr>
<?
$totalesvotos=0;
$totalesasociados=0;
$totalesenblanco=0;
$totalescandidatos=0;
$totaleshanvotado=0;
$contar=0;
$i=1;
$totalesnovotaron=0;
	while (!$result->EOF) {
	$pasar=1;
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}
		$idnits=$result->fields[0];
		$dsnombre=$result->fields[1];
		$dscodigoasociado=$result->fields[2];
		$dszonaelectoral=$result->fields[3];
		$numerovotos="";
		$dsfecha="";
		if ($tipox=="totalc") { 
			$dsfecha=$result->fields[4];
			// traer el total de votos del candidato seleccionado
			
			$sql="select count(*) as t from tblvotacionresultados_votos where dszona='".$dszonaelectoral."' and idtipov=$idtv and dscandidato='$dsnombre' ";
			//echo $sql."<br>";
			$resultx=$db->Execute($sql);
			if (!$resultx->EOF) {	
				$numerovotos=$resultx->fields[0];
			
			}
			$resultx->Close();
			$pasar=1;
		}elseif ($tipox=="totalv") {
			$dsfecha=$result->fields[4];
			$numerovotos=$result->fields[5];
			$psasar=1;
		}elseif ($tipox=="totalb") {
			$dsfecha=$result->fields[4];
			$pasar=1;
		}elseif ($tipox=="totalnv") {
			// verificar que si ha votado lo debe bloquear para no mostrar
			$sql="select idasociado from tblvotacionresultados_votos where dszona='".$dszonaelectoral."' and idtipov=$idtv  and (dscodigo='$idnits' or idasociado='$idnits' or dscedula='$idnits') limit 0,1 ";
			$resultx=$db->Execute($sql);
			$hanvotado=0;	
			if (!$resultx->EOF) {	
				$pasar=2;
			}
			$resultx->Close();
		
			
		}
		if ($pasar==1) { 
	
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
	
			<td align="center">
		  <? echo $i?>
			</td>
	
	
	<td align="center">
		  <? echo $dszonaelectoral?>
			</td>
	
	
	
		  <td align="center">
		  <? echo $dscodigoasociado?></td>
			
			<td align="center">
		  <? echo $dsnombre?></td>
	

		<td align="center">
		 <? echo $dsfecha;?>
			</td>
			
	<td align="center">
		  <? echo $numerovotos;?>
			
			</td>
  <? if ($grafica=="1"){?>
				
		<td align="center">
		  <? echo number_format(($numerovotos/$totalvotos)*100,3,",",".");?> %
			</td>
	<? } ?>			
	

	</tr>
	
		<?
			$i++;
	
		} // fin pasar
		$contar++;
		
		$result->MoveNext();
		} // fin while 
	
?>
<? if ($grafica=="1"){?>

<tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
	
			<td align="center">
		  &nbsp;
			</td>
	
	
	<td align="center">
		  &nbsp;</td>
	
	
	
		  <td align="center">
		  &nbsp;</td>
			
			<td align="center">
		  &nbsp;</td>
	

		<td align="center">
		 &nbsp;	</td>
			
	<td align="center">
		  <? echo $totalvotos;?>
			
			</td>
  			
		<td align="center">
		  &nbsp;
			</td>
	

	</tr>

<? } ?>
</table>
