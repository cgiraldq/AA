<style>
#popup {
	left: 0;
    position: fixed;
    top: 0;

    width: 100%;
    z-index: 1001;
}
.content-popup {
	margin:0px auto;
	margin-top:120px;
	position:relative;
	padding:10px;
	width:900px;
	min-height:300px;
	border-radius:4px;
	background-color:#FFFFFF;
	box-shadow: 0 2px 5px #666666;
}
.content-popup h2 {
	color:#48484B;
	border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}

.popup-overlay {
	left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
	display:none;
	background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}

.close {
	position: absolute;
    right: 15px;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
  $('.open').click(function(){
		$('#popup').fadeIn('slow');
		$('.popup-overlay').fadeIn('slow');
		$('.popup-overlay').height();

		return false;
	});

	$('.closed').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});
});
</script>


<div id="popup" style="display: none;">
    <div class="content-popup">
        <div class="close"><a href="#" class="closed"><img src="../../../images/close.png"/></a></div>
        <div>
        	<h2>Direcci&oacute;n</h2>

	            <div style="float:left; width:100%;">
	               		<label>Nomenclatura </label>

	               <?	$sql=" SELECT dsm,dsabreviatura from tbldirecciones where idactivo=1 ORDER BY dsm ASC ";
	               		$result=$db->Execute($sql);
	               		if (!$result->EOF) {
	               	?>
	               	<select name="nomenclatura1" id="nomenclatura1" onchange="seleccionar()">
	               		<option value=""> Seleccionar</option>
	               		<?
	               			while(!$result->EOF) {
	               				$direccion=$result->fields[0];
	               				$abrev=$result->fields[1];
	               		?>
	               			<option value="<? echo $abrev?>"><? echo reemplazar($direccion);?></option>
	               		<?
	               				$result->MoveNext();
	               			}

	               		?>
	               	</select>
	               	<?
	               	}
	               		$result->Close();
	               	?>


	               	<label>N&uacute;mero </label><input type="text" value="" id="numero1" name="numero1" placeholder="Numero" onblur="seleccionar()" onkeyPress="seleccionar()">
	                 <label>Literal </label><input type="text" value="" id="literal1" name="literal1" placeholder="literal" onblur="seleccionar()" onkeyPress="seleccionar()">


	    		<p>&nbsp;</p>


	               		<label>Nomenclatura </label>
	               <?	$sql=" SELECT dsm,dsabreviatura from tbldirecciones where idactivo=1 ORDER BY dsm ASC ";
	               		$result=$db->Execute($sql);
	               		if (!$result->EOF) {
	               	?>
	               	<select name="nomenclatura2" id="nomenclatura2" onchange="seleccionar()">
	               		<option value=""> Seleccionar</option>
	               		<?
	               			while(!$result->EOF) {
	               				$direccion=$result->fields[0];
	               				$abrev=$result->fields[1];
	               		?>
	               			<option value="<? echo $abrev?>"><? echo reemplazar($direccion);?></option>
	               		<?
	               				$result->MoveNext();
	               			}

	               		?>
	               	</select>
	               	<?
	               	}
	               		$result->Close();
	               	?>

	               	<label>N&uacute;mero </label><input type="text"  value=""id="numero2" name="numero2" placeholder="Numero" onblur="seleccionar()" onkeyPress="seleccionar()">
	                 <label>Literal </label><input type="text" value=""id="literal2" name="literal2" placeholder="literal" onblur="seleccionar()" onkeyPress="seleccionar()">


	    		<p>&nbsp;</p>



	               	<label>Adicional1 </label><input type="text" value="" placeholder="adicional1" id="adicional1" name="adicional1" onblur="seleccionar()" onkeyPress="seleccionar()">
	               	<label>Adicional2 </label><input type="text" value="" placeholder="adicional2" id="adicional2" name="adicional2" onblur="seleccionar()" onkeyPress="seleccionar()">
	               	<label>Adicional3 </label><input type="text" value="" placeholder="adicional3" id="adicional3" name="adicional3" onblur="seleccionar()" onkeyPress="seleccionar()">

	    		</div>
	    		<p>&nbsp;</p>
	    		<input type="text" name="direccion" id="direccion" size="100">

	    		<p>&nbsp;</p>
	    		<div style="float:left; width:100%;">
	               	<input type="button" name="guardar" class="closed" value="Guardar">
	    		</div>
        </div>
    </div>
</div>
<div class="popup-overlay"></div>

<?
$sql="select dscampo from  framecf_tbltiposformulariosxcampo where idactivo=1 and idtipo=13";
$result=$db->Execute($sql);
	    if (!$result->EOF) {
	    	$dsmcampo=$result->fields[0];
	    }
	    $result->Close();
?>

<script type="text/javascript">
	function seleccionar(datos){

		var nomenclatura1=document.getElementById("nomenclatura1").value;
		var numero1=document.getElementById("numero1").value;
		var literal1=document.getElementById("literal1").value;

		var nomenclatura2=document.getElementById("nomenclatura2").value;
		var numero2=document.getElementById("numero2").value;
		var literal2=document.getElementById("literal2").value;

		var adicional1=document.getElementById("adicional1").value;
		var adicional2=document.getElementById("adicional2").value;
		var adicional3=document.getElementById("adicional3").value;

		if(nomenclatura1!=""){nomenclatura1=nomenclatura1+" ";}
		if(numero1!=""){numero1=numero1+" ";}
		if(literal1!=""){literal1=literal1+" ";}

		if(nomenclatura2!=""){nomenclatura2=nomenclatura2+" ";}
		if(numero2!=""){numero2=numero2+" ";}
		if(literal2!=""){literal2=literal2+" ";}

		if(adicional1!=""){adicional1=adicional1+" ";}
		if(adicional2!=""){adicional2=adicional2+" ";}
		if(adicional3!=""){adicional3=adicional3+" ";}

		document.getElementById("direccion").value=nomenclatura1+numero1+literal1+nomenclatura2+numero2+literal2+adicional1+adicional2+adicional3;
		document.u.<? echo $dsmcampo;?>.value=nomenclatura1+numero1+literal1+nomenclatura2+numero2+literal2+adicional1+adicional2+adicional3;
	}
</script>