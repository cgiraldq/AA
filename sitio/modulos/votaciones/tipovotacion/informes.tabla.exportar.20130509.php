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
$nombrecampos="Zona electoral,Maximo votos,Maximo Ganadores,Asociados Habiles,Candidatos,Total Votos, Votos en blanco,Han Votado, No votaron";
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

$totalesnovotaron=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}
		// asociados habiles
		$sql="select count(*) as t from tblvotacionasociados_temp where dszonaelectoral='".$result->fields[6]."'";
		$totala=0;
		$resultx=$db->Execute($sql);
			
		if (!$resultx->EOF) {	
			$totala=$resultx->fields[0];
		
		}
		$resultx->Close();
		$totalesasociados=$totalesasociados+$totala;
		
		// candidatos
		$sql="select count(*) as t from tblcandidatos where idzona='".$result->fields[6]."' and idactivo<>999 and idtipov=$idtv ";
		//echo $sql;
		$totalc=0;
		$resultx=$db->Execute($sql);
			
		if (!$resultx->EOF) {	
			$totalc=$resultx->fields[0];
		
		}
		$resultx->Close();
		$totalescandidatos=$totalescandidatos+$totalc;
		
		// totalvotos
		$sql="select count(*) as t from tblvotacionresultados_votos where dszona='".$result->fields[6]."' and idtipov=$idtv ";
		$totalv=0;
		$resultx=$db->Execute($sql);
			
		if (!$resultx->EOF) {	
			$totalv=$resultx->fields[0];
		
		}
		$resultx->Close();
		$totalesvotos=$totalesvotos+$totalv;
		// votos en blanco
		$sql="select count(*) as t from tblvotacionresultados_votos where dszona='".$result->fields[6]."' and idtipov=$idtv and dstipo='VOTO EN BLANCO'";
		$totalb=0;
		$resultx=$db->Execute($sql);
			
		if (!$resultx->EOF) {	
			$totalb=$resultx->fields[0];
		
		}
		$resultx->Close();
		$totalesenblanco=$totalesenblanco+$totalb;
		// no han votado
		
		// saber cuantas personas han votado
		$sql="select count(*) as t,idasociado from tblvotacionresultados_votos where dszona='".$result->fields[6]."' and idtipov=$idtv  group by idasociado ";
		$resultx=$db->Execute($sql);
		$hanvotado=0;	
		if (!$resultx->EOF) {	
			while (!$resultx->EOF){
			$hanvotado++;
			$resultx->MoveNext();
			}
		}
		$resultx->Close();
		$totaleshanvotado=$totaleshanvotado+$hanvotado;
		// no han votado
		$totalnv=$totala-$hanvotado;
		$totalesnovotaron=$totalesnovotaron+$totalnv;
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  
	<td align="center">
		  <? echo $result->fields[6]?>
			</td>
	
	
	
		  <td align="center">
		  <? echo $result->fields[3]?></td>
			
			<td align="center">
		  <? echo $result->fields[4]?></td>
	

		<td align="center">
		 <? echo $totala;?>
			</td>
			
	<td align="center">
		  <? echo $totalc;?>
			
			</td>
		
		<td align="center">
		  <? echo $totalv?>
			</td>
			
			<td align="center">
		 <? echo $totalb?>
			</td>
			
		<td align="center">
		  <? echo $hanvotado;?>
			</td>
		
		
		<td align="center">
		  <? echo $totalnv;?>
			</td>
			</tr>
	
		<?
		$contar++;
		$result->MoveNext();
	} // fin while 
?>

<tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  
	
		<td align="center">
		  &nbsp;
			</td>
	
	
		  <td align="center">
		  &nbsp;</td>
			
			<td align="center">
		  &nbsp;</td>
	

		<td align="center">
		  <? echo $totalesasociados;?>
			</td>
			
	<td align="center">
		  <? echo $totalescandidatos;?>
			</td>
		
		<td align="center">
		  <? echo $totalesvotos;?>
			</td>
			
			<td align="center">
		 <? echo $totalesenblanco?>
			</td>
		
		<td align="center">
		  <? echo $totaleshanvotado?>
			</td>
			
		<td align="center">
		 <? echo $totalesnovotaron?>			
		 </td>
			
			
			</tr>
	

</table>
