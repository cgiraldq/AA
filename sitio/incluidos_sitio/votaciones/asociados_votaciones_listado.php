<?
// listado de candidatos de acuerdo a la zona
$dsrutay="../contenidos/images/fichatecnica/";
$control=2;
?>

<div class="cont_votaciones_listado">

<table width="100%" border="0" cellpadding="2" cellspacing="1" >
	<form action="modulos/validaciones/asociados_votaciones_guardar.php" method="post" name="a">

<?
// Listado generales de la parte superior en el contenedor debajo del menu de opciones
$sql="select id,dsasociado,idasociado,foto from tblcandidatos  where idzona='$zonaelectoral' and idtipov='$idtv' and idactivo not in (999) order by rand() ";
//echo $sql;
//echo $sql;
$result=$db->Execute($sql);
	if (!$result->EOF) {

?>



	<tr>

	<?
	$i=0;
		while(!$result->EOF){

	?>	<?

	include('asociados_votaciones_listado.detalle.php');
	$result->MoveNext();
		if ($i==$control) {
			echo "</tr><tr>";
			$i=0;
		} else {
			$i++;
		}
	}


?>
    		</tr>


			<?
}
$result->Close();
?>


			<?
			// VOTO EN BLANCO

			// FIN VOTO EN BLANCO
			?>

			<tr bgcolor="#FBFAF7">
				<td  align="center" colspan=3><h2>VOTO EN BLANCO</h2></td>
			</tr>


					<tr>
					<td align=center></td>
					<td align=center>
					<img src="images/iconos/candidato.jpg" border="0"  alt="Voto en Blanco"  />
					<br>
					<input name="votoblanco"  type="checkbox"  onclick="VotoBlanco();">
					</td>
					<td align=center></td>


	  				<tr>
					<td colspan=3 align=center>
					<div id="votar">

					<a href="#" onClick="enviarconfirm('Esta seguro de realizar la votacion?','Recuerde que este proceso no se puede repetir.',1,'');" title="" class="btn_color"><p >Votar</p></a>

					<input type=hidden name=idtv value="<? echo $idtv;?>">
					<input type=hidden name=dstv value="<? echo $dstv;?>">
					<input type=hidden name=idx value="<? echo $idx;?>">
					<input type=hidden name=dsx value="<? echo $dsx;?>">
					<input type=hidden name=idy value="<? echo $idy;?>">
					<input type=hidden name=dsy value="<? echo $dsy;?>">
					<input type="hidden" name="maxivt" value="<? echo $maximovotos; ?>" />

					</div>
					</td>
				</tr>
</form>

    	</table>
		    </div>


			<!-- Cierra contenedor_iconos_asociados -->

<script language="javascript">
<!--
	function capa(param){
		document.com.iddoc.value=param;
		document.getElementById('capa').style.display="";
	}



function SumarTodo(forma1) {
var forma=eval("document."+forma1);
}


	function VotoBlanco() {
  	if (confirm("Esta seguro de votar en blanco?.")==true) {
		location.href="modulos/validaciones/asociados_votaciones_guardar.php?blanco=1&idficha=9999&idcandidato=9999&dscandidato=EN BLANCO&zonaelectoral=<? echo $zonaelectoral; ?>&idy=<? echo $idy;?>&dsy=<? echo $dsy;?>&idx=<? echo $idx;?>&dsx=<? echo $dsx;?>&idtv=<? echo $idtv;?>&dstv=<? echo $dstv;?>";
			document.getElementById('votar').style.display = "none";
	}else {

		alert("Recuerde que esta opcion no se puede devolver");
		return;
	}
 }







function MaxiVot()
  {
  var sa=false;
  acum=0;
  sa=true;

   for (var i=0;i<document.a.elements.length;i++)
    {
    var e = document.a.elements[i];
    if(document.a.elements[i].checked)
     //e.checked=true;
      acum=acum+1;
	 }

	if(acum>eval(document.a.maxivt.value)){
	alert("el maximo de opciones permitidas es de <? echo $maximovotos; ?> opciones ");

	for (var i=0;i<document.a.elements.length;i++)
    {
    var e = document.a.elements[i];
    if(document.a.elements[i].checked)
     e.checked=false;
    }
	}

 }

function enviarconfirm(m1,m2,tipo,redir){

   var sa=false;
  acum=0;
  sa=true;
   for (var i=0;i<document.a.elements.length;i++)
    {
    var e = document.a.elements[i];
    if(document.a.elements[i].checked){
     //e.checked=true;
      acum=acum+1;
	 }
	}

	if(acum<1){
	alert("Recuerde que debe elegir como minimo una opcion");
	return ;
	}
	     if (confirm(m1)== true ){
			if (tipo==1){
			document.a.votoblanco.style.visibility='hidden';
			document.getElementById('votar').style.display = "none";
			document.a.submit();
			} else{

			location.href=redir;


			}
		} else {

			alert(m2);

			return;
	}
}
//-->
</script>

