
<article class="cont_noticias_lateral">
<article class="titulos_aside">
	 <? if($_SESSION['idioma']==1){ ?>
	<p>HISTÓRICO DEL BLOG</p>
	<?}?>

	 <? if($_SESSION['idioma']==2){ ?>
	<p>Historic</p>
	<?}?>
</article>
<article class="calendario">



<!--script text="javascript">
    function ActivarTiempo(){
        //se activa el método alert luego de 2 segundos
        setTimeout("alert('Pasaron 2 segundos!')",2000);
    }
</script>

<input type="button" value="Sale un mensaje pasado 2 segundos" onclick="ActivarTiempo()"/-->

		<article class="cont_frm_vertical">
			<form action="#" name="frm_calendario" method="post" id="frm_calendario">
						<fieldset>
						 <? if($_SESSION['idioma']==1){ ?>
						<label for="idanio">Año</label>
						<?}?>

						<? if($_SESSION['idioma']==2){ ?>
						<label for="idanio">Year</label>
						<?}?>
							<div>
								<select name="idanio" id="idanio" onchange="cargarvalores('<? echo $rutbase ?>')">
								 <? if($_SESSION['idioma']==1){ ?>
								<option value="0">Seleccione el año</option>
								<?}?>

								 <? if($_SESSION['idioma']==2){ ?>
								<option value="0">Select a year</option>
								<?}?>
					            <? for ($i=2014;$i<=2016;$i++) {?>
									<option value="<? echo $i?>"><? echo ($i)?></option>
					            <? } ?>
								</select>
							</div>
						<span class="camp_requerido" id="capax_idanio" style="display:none;"></span>
				</fieldset>
				<div id="calendario" style="display:none">
				<fieldset>
					<? if($_SESSION['idioma']==1){ ?>
								<label for="dsmes">Mes</label>
								<?}?>
					<? if($_SESSION['idioma']==2){ ?>
								<label for="dsmes">Month</label>
								<?}?>

						<div>
						<select name="idmes" id="idmes"  onchange="cargarvalores('<? echo $rutbase ?>')">
						 <? if($_SESSION['idioma']==1){ ?>
								<option value="">Seleccione el mes</option>
								<?}?>
						<? if($_SESSION['idioma']==2){ ?>
								<option value="">Select the month</option>
								<?}?>

						<?
						for ($i=1;$i<13;$i++){
						if ($i<10){
						$i1="0".$i;
						}else{
						$i1=$i;
						}
						?>
						<option value="<? echo $i1;?>"><? echo nombre_mes($i)?></option>
						<? } ?>
							</select>
						</div>
					<!--input type="hidden" id="dsresultado"  name="" value=""  -->
					<span class="camp_requerido" id="capax_idmes" style="display:none;"></span>
				</fieldset>
				<fieldset>
					 <? if($_SESSION['idioma']==1){ ?>
								<label for="dstipo">Tema</label>
								<?}?>
					 <? if($_SESSION['idioma']==2){ ?>
								<label for="dstipo">Topic</label>
								<?}?>

					<article class="temas" id="idtipo">

					</article>
				</fieldset>
			</div>
			<?//include("incluidos_sitio/captcha.php");?>
			</form>
		</article>
</article>

</article>

<script language="javascript">
	<!--
	function cargarvalores(rutbase) {
	var aniox= document.frm_calendario.idanio.value;
	var idmesx= document.frm_calendario.idmes.value;

	if (aniox!="" && idmesx!="") {
	                               conexionm=AjaxObj();
	                               var capa=document.getElementById('idtipo');
	                               if (capa) capa.innerHTML="Cargando...-";
                                   //conexionc.open("POST",rut+"modulos/validaciones/cargar.categorias.php?param="+valorx+"&ruta="+rut,true);
	                               conexionm.open("POST",rutbase+"modulos/validaciones/cargar.blog.php?aniox="+aniox+"&idmesx="+idmesx+"&ruta="+rutbase,true);
	                               conexionm.onreadystatechange =function() {
	                                               if (conexionm.readyState==4) {
	                                               var _resultado = conexionm.responseText;
	                                              	//alert(_resultado);
	                                                if (_resultado !="-1") {
                                                   if (capa) capa.innerHTML=_resultado;

	                                               } else {
	                                               	 <? if($_SESSION['idioma']==1){ ?>
	                                               if (capa) capa.innerHTML="No hay datos asociados. Intente de nuevo";
	                                               <?}?>

	                                                <? if($_SESSION['idioma']==2){ ?>
	                                               if (capa) capa.innerHTML="There is no associated data. Try again";
	                                               <?}?>

	                                               }
	                                                  // fin resultado
	                               } // fin conexionm
	                  } // fin funcion conexionm interna
	                  conexionm.send(null) // limpia conexion

	}
if (document.frm_calendario.idanio.value!=0){
	document.getElementById("calendario").style.display="block";
}else if(document.frm_calendario.idanio.value==0){

document.getElementById("calendario").style.display="none";

}

		}
	//-->
</script>


