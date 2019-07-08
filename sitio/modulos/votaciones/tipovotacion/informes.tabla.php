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


<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<tr>
<?
// encabezado generico basado
$nombrecampos="Zona electoral,Resultados Votaciones,Maximo votos,Maximo Ganadores,Asociados Habiles,Candidatos,Votos, Votos en blanco,Han Votado, No votaron";
  $partir=explode(",",$nombrecampos);
	  $total=count($partir);



	  for ($i=0;$i<$total;$i++) {
?>
 <td align="center" background="../../img_modulos/fondo3.jpg" class="text1">
	  <? if ($partir[$i]=="Posici&oacute;n"){ ?>
		<a href="<? echo $pagina?>?<? echo $rutaPaginacion;?>&orderby=idpos" title="Ordenar por"><? echo $partir[$i];?></a>
	  <? } else {
		echo $partir[$i];
	  }?>
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
		$sql="select count(*) as t from tblvotacionasociados_temp a, tblvotacionasociados b where ";
		$sql.=" a.dscodigo=b.dscodigo and a.dszonaelectoral='".$result->fields[6]."'";
		$sql.=" and b.idtipov='".$idtv."'";

		$totala=0;
		$resultx=$db->Execute($sql);

		if (!$resultx->EOF) {
			$totala=$resultx->fields[0];

		}
		$resultx->Close();
		$totalesasociados=$totalesasociados+$totala;

		// candidatos
		$sql="select count(*) as t from tblcandidatos where idzona='".$result->fields[6]."' and idactivo<>999 and idtipov=$idtv ";
		$totalc=0;
		$resultx=$db->Execute($sql);

		if (!$resultx->EOF) {
			$totalc=$resultx->fields[0];

		}
		$resultx->Close();
		$totalescandidatos=$totalescandidatos+$totalc;

		// totalvotos
		$sql="select count(*) as t from tblvotacionresultados_votos where dszona='".$result->fields[6]."' and idtipov=$idtv  and dstipo='VOTO POR ASOCIADO' ";
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
			<a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalv&paramx=Total Votos&idtv=<? echo $idtv?>&zona=<? echo $result->fields[6]?>&grafica=1&totalvotos=<? echo $totalv?>')">Ver</a>
			</td>


		  <td align="center">
		  <? echo $result->fields[3]?></td>

			<td align="center">
		  <? echo $result->fields[4]?></td>


		<td align="center">
		 <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totala&paramx=Total Asociados&idtv=<? echo $idtv?>&zona=<? echo $result->fields[6]?>')"><? echo $totala;?></a>
			</td>

	<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalc&paramx=Total Candidatos&idtv=<? echo $idtv?>&zona=<? echo $result->fields[6]?>')"><? echo $totalc;?></a>

			</td>

		<td align="center">
		 <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalv&paramx=Total Votos&idtv=<? echo $idtv?>&zona=<? echo $result->fields[6]?>&totalvotos=<? echo $totalv?>')"><? echo $totalv?></a>
			</td>

			<td align="center">
		 <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalb&paramx=Total Votos En Blanco&idtv=<? echo $idtv?>&zona=<? echo $result->fields[6]?>')"><? echo $totalb?></a>
			</td>

		<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=hanvotado&paramx=Total que Han Votado &idtv=<? echo $idtv?>&zona=<? echo $result->fields[6]?>')"><? echo $hanvotado;?></a>
			</td>


		<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalnv&paramx=Total que no Han Votado&idtv=<? echo $idtv?>&zona=<? echo $result->fields[6]?>')"><? echo $totalnv;?></a>
			</td>
			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>

<tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

	<td align="center">
		  &nbsp;</td>

		<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalv&paramx=Total Votos&idtv=<? echo $idtv?>&zona=&grafica=1&totalvotos=<? echo $totalesvotos?>')">Ver todo</a>
			</td>


		  <td align="center">
		  &nbsp;</td>

			<td align="center">
		  &nbsp;</td>


		<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totala&paramx=Total Asociados&idtv=<? echo $idtv?>&zona=')"><? echo $totalesasociados;?></a>
			</td>

	<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalc&paramx=Total Candidatos&idtv=<? echo $idtv?>&zona=')"><? echo $totalescandidatos;?></a>
			</td>

		<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalv&paramx=Total Votos&idtv=<? echo $idtv?>&zona=&totalvotos=<? echo $totalesvotos?>')"><? echo $totalesvotos;?></a>
			</td>

			<td align="center">
		 <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalb&paramx=Total Votos En Blanco&idtv=<? echo $idtv?>&zona=')"><? echo $totalesenblanco?></a>
			</td>

		<td align="center">
		  <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=hanvotado&paramx=Total que Han Votado &idtv=<? echo $idtv?>&zona=')"><? echo $totaleshanvotado?></a>
			</td>

		<td align="center">
		 <a href="javascript:irAPaginaDN('informes.detalle.php?tipox=totalnv&paramx=Total que no Han Votado&idtv=<? echo $idtv?>&zona=')"><? echo $totalesnovotaron?></a>
		 </td>


			</tr>
	<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Exportar"  class="botones">
<input type="hidden" name="idtv" value="<? echo $idtv?>">

</td></tr>
</form>

</table>
