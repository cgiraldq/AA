<article id="pedidos" class="cuerpo_zona_distribuidor">
<? 
$productos=$_REQUEST['producto'];//  RECOGE LOS PRODUCTOS CON ERROR AL DUPLICAR EL PEDIDO
$contarX=count($productos);
$preciomindistrib=seldato("dspreciomindistrib","id"," tblclientes",$_SESSION['i_idcliente'],1);//
?><!--VALOR MINIMO DE COMPRA DISTRIBUIDOR-->

<h1>Bienvenido <?echo reemplazar($_SESSION['i_dsnombre']);?></h1>

	<table  width="100%" class="cbz_carrito_distribuidor" border=0 border-collapse="0" border-spacing="0" cellspacing="0">
		<tr>
			<td class="campo1">


				<?if($_SESSION['i_dscodigo']=="" && $_SESSION['i_dsdescuento']==""){?>
				<article class="codigo_carrito">
				<h3>CÓDIGO PROMOCIONAL</h3>
				<form action="/<? echo $rutbase?>/ecommerce.buscador.php" method=post name="ecoomerce_frm_buscador">
				<input type="text" name="dscodigo_promo" id="dscodigo_promo" placeholder="Código">
				<input type="button" onclick="validar_codigo_promo()" value="IR">
				</form>
				<span id="txt_codigo" style="display:none" class="camp_requerido"></span>
				</article>



				<?}else{?>
				<article class="codigo_carrito">
					<h3>PATROCINADOR <?echo $_SESSION['i_dsproveedor']?></h3>
					<h4>DESCUENTO  <?echo  $_SESSION['i_dsdescuento']?>%</h4>
					<? $rutaImagen_p=$rutaFuenteImagenes."/contenidos/images/ecommerce_patrocinadores/";
					if(is_file($rutaImagen_p.$_SESSION['i_img'])){
					?>
					<img src="<?echo $rutaImagen_p.$_SESSION['i_img']?>">
					<?	}?>
				</article>

				<?
				}
				?>

<?




?>










			</td>

			<td class="campo2">
				<h1>PEDIDOS DEL DISTRIBUIDOR</h1>
			</td>
		</tr>
	</table>



		<table width="100%" class="ecommerce_productos_distribuidor" border=0 border-collapse="0" border-spacing="0" cellspacing="0">
		<form action="proceso.distribuidor.php" method="POST" name="forma_carrito">
		<?
		//====================== CONFIGURACION DESDE CONSOLA EQUIVALENICIAS  PARA LOS PÚNTOS ===========================// 
		$sql_p="select dsd,dsd2 from ecommerce_tblequivalenciaputos  where id>0  and idactivo not in (2,9) and dsd<>'' and dsd2<>'' order by idpos asc limit 0,1";
		$result_p = $db->Execute($sql_p);
		if (!$result_p->EOF) {?>
		<input type="hidden" name="valorp" id="valorp" value="<?echo $result_p->fields[0]?>">
		<input type="hidden" name="punto"  id="punto" value="<?echo $result_p->fields[1]?>">

		<?}
		$result_p->close();
		//====================== FIN CONFIGURACION DESDE CONSOLA EQUIVALENICIAS  PARA LOS PÚNTOS ===========================// 

		?>
		<thead>
			<tr>
				<td><img src="images/carrito_zona.png"></td>
				<td >Producto</td>
				<td>Color</td>
				<td>Talla </td>
				<td>Unidad</td>
				<td>Unidades disponibles</td>
				<td>Cantidad</td>
				<td>Valor Unitario</td>
				<td>Valor</td>
				<td>Opciones</td>
			</tr>
		</thead>
			<tbody>
			<?if($contar>0){?>
			<tr class="titulo_categoria">
				<td colspan="10" class="campo"><?echo $productosx?></td><!--CATEGORIA-->
			</tr>
			<?}?>
			<?
			//$db->debug=true;
			// armazon de productos
			$xprecio=2;
            $sql="select a.id,a.dsm ";
            $sql.=" from ecommerce_tblcategoria a";
            $sql.=" where a.id >0 and a.idactivo not in (2,9) ";
            $sql.=" order by a.idpos asc ";
          	//echo $sql;
            $rutaPaginacion="idcat=".$_REQUEST['idcat']."&search=".$_REQUEST['search'];
			//echo $sql;
            $maxregistros=12;
            include("incluidos_modulos/paginar.variables.php");
 			$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
            if(!$result->EOF){
			?>
			<?
			$i=0;
            while (!$result->EOF /*&& ($contar<$maxregistros)*/) {

            $idc=reemplazar($result->fields[0]);
            $dsm=reemplazar($result->fields[1]);
            ?>
    		<tr class="titulo_categoria">
				<td colspan="10" class="campo"><? echo $dsm ?></td><!--CATEGORIA-->
    	 	</tr>
    	 	<?
    	 	// armazon de productos
            $sqld="select a.id,a.dsm ";
            $sqld.=" from ecommerce_tblsubcategoriasxcategoria a,ecommerce_tblcategoriaxsubcategoria b";
            $sqld.=" where a.id >0 and a.idactivo not in (2,9) ";
            $sqld.=" and b.iddestino=".$idc." and a.id=b.idorigen";
            $sqld.=" order by a.idpos asc ";
           	//echo $sqld;
			//echo $sqld;
   			$resultd=$db->Execute($sqld);
 			//$db->debug=true;
            if(!$resultd->EOF){
			?>
			<?
	    while (!$resultd->EOF) {
			$idsub=reemplazar($resultd->fields[0]);
			$dsmc=reemplazar($resultd->fields[1]);
            ?>
	    	<tr class="titulo_subcategoria">
				<td colspan="10" class="campo"><? echo $dsmc ?></td><!--Subcategoria-->
	    	</tr>
			<?
    	 	// productos
    	 	$rutaImagen=$rutaFuenteImagenes."/contenidos/images/ecommerce_productos/";
       		$sqls="select a.id,a.dsm,a.dsimgcarrito,a.dsreferencia,";
            $sqls.="a.dsunidad,c.dsunidad,c.dsprecio2,a.dsruta,a.iva,c.iddestino,c.idcolor,a.dsflete";
            $sqls.=" from ecommerce_tblproductos a,ecommerce_tblsubcategoriaxtblproducto b ";
            $sqls.=", ecommerce_tbltallasxtblproductos c ";
            $sqls.=" where a.id >0 and a.idactivo not in (9,2) and  a.id=b.idorigen and b.iddestino=".$idsub;
           	$sqls.=" and c.idorigen=a.id ";
           	//$sqls." and c.dsunidad > 0 ";
            $sqls.=" order by a.idpos asc ";
   			$results=$db->Execute($sqls);
 			//$db->debug=true;
            if(!$results->EOF){
			?>
			<?
	        $contar=0;
	       	$xsubtotal=0;
          	$xdescuento=0;
          	$xiva=0;
          	$xfletes=0;
          	$xvalorseguro=0;
          	$dsfelte=0;
          	$promodescuento=0;
          	$promodescuentom=0;
            while (!$results->EOF) {

     	    $idp=reemplazar($results->fields[0]);
            $dsms=reemplazar($results->fields[1]);
            $dsimgcarrito=seldato('dsimg','iddestino','ecommerce_tblproductoximg',$idp,1);
            $dsreferencia=reemplazar($results->fields[3]);
            $dsunidad=reemplazar($results->fields[4]);
            $dsunidadesdispo=reemplazar($results->fields[5]);
            $preciodistribuidor=reemplazar($results->fields[6]);
            $dsporiva=$results->fields[8];

            $idtalla=$results->fields[9];
            $idcolor=$results->fields[10];
            $dscolor = seldato('dsm','id','ecommerce_tblcolores',$idcolor,1);
            $dstalla = seldato('dsm','id','ecommerce_tbltallas',$idtalla,1);
            $dsflete=$results->fields[11];//  valor de manejo de losjistica por producto
            if($dsflete=="")$dsflete=0;
            $dsruta=$results->fields[7];
            $dsrutax=$rutalocal."/producto/";
            $dsrutax.=$dsruta;
            if ($rutaAmiga>1) $dsrutax="ecommerce.productos.detalle.php?idrelacion=".$idp."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];
            if ($dsruta=="") $dsrutax=$rutbase."ecommerce.productos.detalle.php?idrelacion=".$idp."&dscategoria=".$_REQUEST['dscategoria']."&subcate=".$_REQUEST['idrelacion'];


            //***********************promociones********************************-//
            			 $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino= $idp or dsref='$dsreferencia')";
                        $sqldes.=" and b.idorigen=a.id ";
                       // echo "<br>".$sqldes."<br>--productos";
                        $result_des=$db->Execute($sqldes);
                        if(!$result_des->EOF){
                        $xpromoproducto=1;
                        $promodescuento=($result_des->fields[1]);
                        $idpreciox=($result_des->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','tbltblproductoxcategoria',$idp,1)."'";
                       // echo "<br>".$sqldes."<br>--Categoria";
                        $resultY=$db->Execute($sqldes);
                        if(!$resultY->EOF){
                        $xpromocatecoria=1;
                        $promodescuento=($resultY->fields[1]);
                        $idpreciox=($resultY->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.=" ecommerce_tblpromocionesxsubcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tblsubcategoriaxtblproducto',$idp,1)."'";
                        //echo $sqldes."<br>--Sub";
                        $resultx=$db->Execute($sqldes);
                        if(!$resultx->EOF){
                        $xpromosubcategoria=1;
                        $promodescuento=($resultx->fields[1]);
                        $idpreciox=($resultx->fields[2]);
                        }$resultx->Close();//  Fin Subcategoria
                        }$resultY->Close();// Fin  promocion Categoria
                        }$result_des->Close();// Fin  promocion producto

   				//***********************promociones********************************-//
                        $pordescuentom=$promodescuento;
                        $preciodescuento=($preciodistribuidor*($promodescuento/100));//  Valor Descunto
                        $preciodistribuidor= ($preciodistribuidor-$preciodescuento);
                        $preciodistribuidorx=$preciodistribuidor;
                        $precioiva=($preciodistribuidor*($dsporiva/100));
                        $preciodistribuidor= $preciodistribuidor+($preciodistribuidor*($dsporiva/100)+$dsflete);   

						$cantidad_g=cargar_cantidad($idp,$idcolor,$idtalla,$idc,$idsub);// cantidad  que se a guardado en  la tabla temporal de compras
						
						$xcomp=$idp."|".$idtalla."|".$idcolor."|".$idsub."|".$idc;
						$xx="";
						for ($i=0; $i <$contarX ; $i++) { 
						if($productos[$i]==$xcomp)$xx=1;
						}

						if($cantidad_g==0){
						$xdisplay="none";
						}else{
						$xdisplay="";
						}
						?>	


			<tr class="campo_producto" >
			<td class="campo_img">
				<?if (is_file($rutaImagen.$dsimgcarrito)){ ?>
				<a href="<? echo $dsrutax ?>">
				<img src="<? echo $rutaImagen.$dsimgcarrito;?>">
				</a>
				<?}else{?>
				<a href="<? echo $dsrutax ?>"><img src="<?echo  $rutbase?>/images/img_sin.png" alt=""></a>
				<?}?>
			</td>
							
							<td><? echo $dsms ?></td>

							<td><?echo reemplazar($dscolor)?></td>
							<td><?echo reemplazar($dstalla)?></td>
							<td><? if($dsunidad<>""){ ?>X <? echo $dsunidad ?><? }else{ ?><?} ?></td>
							<td>
							<label id="unidid_dis_<?echo $i?>">
							<? if($dsunidadesdispo<>""){ ?><? echo $dsunidadesdispo ?><? }else{ ?><? } ?>
							</label>
							</td>
							<td>
							<input type="text"  name="cantidad[]" size="2" id="cantidad[]" value="<?echo $cantidad_g?>" onkeydown="return validacion()" onBlur="guardar_cantidad(<? echo $i?>);" >
							</td>
							<td><? echo number_format($preciodistribuidor,0) ?>
							</td>
							<td>
							<input type="text" name="total[]" size="20" value="" id="total[]">
							<input type="hidden" name="nombreprod[]" value="<? echo $dsms ?>">
							<input type="hidden" name="dsdescuento[]" value="<? echo $preciodescuento ?>">
							<input type="hidden" name="unidadispo[]" value="<? echo $dsunidadesdispo ?>">
							<input type="hidden" name="valorunitario[]" value="<? echo $preciodistribuidor ?>">
							<input type="hidden" name="valorneto[]" value="<? echo $preciodistribuidorx ?>">
							<input type="hidden" name="unidadesdispo[]" value="<? echo $dsunidadesdispo ?>">
							<input type="hidden" name="idpro[]" value="<? echo $idp ?>" />
							<input type="hidden" name="idcolor[]" value="<? echo $idcolor ?>" />
							<input type="hidden" name="idtalla[]" value="<? echo $idtalla ?>" />
							<input type="hidden" name="dstalla[]" value="<? echo $dstalla ?>" />
							<input type="hidden" name="dscolor[]" value="<? echo reemplazar($dscolor) ?>" />							
							<input type="hidden" name="dsflete[]" value="<? echo $dsflete ?>" />
							<input type="hidden" name="dsiva[]" value="<? echo $precioiva ?>" />
							<input type='hidden' name='idpos[]' value='<? echo $i;?>' id='idpos[]'>
							<input type='hidden' name='idcate[]'value='<? echo $idc;?>' >
							<input type='hidden' name='idsubc[]'value='<? echo $idsub;?>' >
							</td>
							<td>
								<img id="img_<? echo $i?>" style="display:<?echo $xdisplay?>" src="images/menos.png" onclick="eliminar_dis(<? echo $i?>)">
							</td>

			</tr>
			<tr id="tr_<? echo $i?>" style="display:none">
			<td colspan="10"><label id="mensaje_error_<? echo $i?>"></label></td><!--tr capa mensajes de error -->
			</tr>
			<?if($xx==1){?>
			<tr style="display:">
			<td colspan="10">PRODUCTO  <?echo strtoupper($dsms)?>  NO PUDO SER DUPICADO </td><!--tr capa mensajes de error -->
			</tr>
			<?}?>



		 <?
        $i++;
        $results->MoveNext();
        }
		?>
		<?
			// fin armazon de productos
			}
			$results->Close();
			?>
			<?
				$resultd->MoveNext();
				}
			?>
			<?
			// fin armazon de productos
				}
				$resultd->Close();
			?>
	    <?
        $contar++;
        $result->MoveNext();
        }
		?>
<?
// fin armazon de productos
//$db->debug=false;
        include("incluidos_modulos/index.paginar.php");
}
        $result->Close();
?>
</tbody>

</table>

<div class="aling_derecha">

	<table class="total_distribuidor">
		<tr><td>Subtotal:</td>
			<td>$ <label id="subtotal_t"> 0</label></td>
		</tr>
		<tr>
			<td>Descuento:</td>
			<td>$ <label id="total_descunto"> 0</label></td>
			</tr>
		<tr>
			<td>Impuesto:</td>
			<td>$ <label id="total_iva"> 0</label></td>
		</tr>
		<tr>
		<td>Transporte:</td>
		<td>$ <label id="total_flete"> 0</label></td>
		</tr>
		<tr>
			<td>Puntos:</td>
			<td> <label id="puntos_redimir"> 0</label></td>
		</tr>
		<tr>
			<td class="p_total">Total:	</td>
			<td class="p_total">$ <label id="ptotal"> 0</label> </td>
		</tr>
	</table>
</div>

	<nav class="btn_derecha">

		<a  class="btn_general" onclick="totales();validar_distribuidorx()">GUARDAR PEDIDO</a>
		<a  class="btn_general" onclick="totales();validar_distribuidorx()">FINALIZAR Y ENVIAR PEDIDO</a>

	</nav>		
				<input type="hidden" name="totalvalor" value="<? echo $dstotal ?>" onBlur="totales();">
				<input type="hidden" name="puntos" >
				<input type="hidden" name="dscodigodis" value="<? echo $_SESSION['i_idcodigodis'] ?>" >
				<input type='hidden' name='preciomindistrib' class='forma2' value='<? echo $preciomindistrib;?>' id='preciomindistrib'>
			
</article>
	
</form>


<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

function calcularsubtotal(pos){

for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){
if (i==pos) {
var y=document.forma_carrito.elements['cantidad[]'][i].value;
if (y>0) {
var x=document.forma_carrito.elements['valorunitario[]'][i].value;
var z=(parseFloat(x)*parseFloat(y));
document.forma_carrito.elements['total[]'][i].value=redondear(z);

}else{
document.forma_carrito.elements['total[]'][i].value=""	
}			
break;
}
}
totales();
}


function eliminar_dis(pos) {
var m1="Esta Seguro de eliminar el registro";
if (confirm(m1)== true ){

			var dscodigodis=document.forma_carrito.elements['dscodigodis'].value;
			for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){

			if (i==pos) {
				//alert(i)
				var cantidadx=document.forma_carrito.elements['cantidad[]'][i].value;
				var cantidad=document.forma_carrito.elements['unidadesdispo[]'][i].value;
				var idcolor=document.forma_carrito.elements['idcolor[]'][i].value;
				var dscolor=document.forma_carrito.elements['dscolor[]'][i].value;
				var idtalla=document.forma_carrito.elements['idtalla[]'][i].value;
				var dstalla=document.forma_carrito.elements['dstalla[]'][i].value;
				var idproducto=document.forma_carrito.elements['idpro[]'][i].value;
				var valorx=document.forma_carrito.elements['valorunitario[]'][i].value;

				var idcat=document.forma_carrito.elements['idcate[]'][i].value;
				var idsub=document.forma_carrito.elements['idsubc[]'][i].value;

				if(idproducto!="" && (cantidad>0 || cantidad!="")){

				conexion1=AjaxObj()
				conexion1.open("POST","modulos/validaciones/adicionar.wear.php?idproducto="+idproducto+"&idcolor="+idcolor+"&idtalla="+idtalla+"&dscodigodis="+dscodigodis+"&eliminar=1&idcate="+idcat+"&idsub="+idsub,true);
				conexion1.onreadystatechange =function() {
						if (conexion1.readyState==4) {
								var _resultado = conexion1.responseText;
								if (_resultado == -1) {

								document.getElementById("mensaje_error_"+pos).innerHTML="No Fue Posible Eliminar Los Datos";

								} else{

								
								document.getElementById("img_"+pos).style.display="none";
								document.getElementById("tr_"+pos).style.display="";
								document.getElementById("unidid_dis_"+pos).innerHTML=cantidadx;

								document.getElementById("mensaje_error_"+pos).innerHTML="Datos Eliminados Con &Eacute;xito";
								//alert(i)
								document.forma_carrito.elements['cantidad[]'][pos].value=0;
								document.forma_carrito.elements['total[]'][pos].value="";

								calcularsubtotal(pos);

								}
						} // fin conexion1
				} // fin funcion conexion1 interna
				conexion1.send(null) // limpia conexion    
				}else{
				document.getElementById("mensaje_error_"+pos).innerHTML=" ITEM NO POSEE UNIDADES PARA ELIMINAR ";
				
				}//( fin if )
								

		


				}// fin if  pos//
			}// fin for 

			} 
}







function guardar_cantidad(pos){
var idproducto="";
var errorpos="";//  mensaje de error 
var dscodigodis=document.forma_carrito.elements['dscodigodis'].value;
			for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){

			if (i==pos) {
				nombreprod=document.forma_carrito.elements['nombreprod[]'][i].value
				var cantidad=parseInt(document.forma_carrito.elements['cantidad[]'][i].value);
				var unidadesdispo=parseInt(document.forma_carrito.elements['unidadesdispo[]'][i].value);
				//alert(cantidad+"------"+unidadesdispo)
				if(eval(unidadesdispo>=cantidad)){


				if(cantidad>0){

							var idcolor=document.forma_carrito.elements['idcolor[]'][i].value;
							var dscolor=document.forma_carrito.elements['dscolor[]'][i].value;
							var idtalla=document.forma_carrito.elements['idtalla[]'][i].value;
							var dstalla=document.forma_carrito.elements['dstalla[]'][i].value;

							var idcat=document.forma_carrito.elements['idcate[]'][i].value;
							var idsub=document.forma_carrito.elements['idsubc[]'][i].value;

							var idproducto=document.forma_carrito.elements['idpro[]'][i].value;
							var valorx=document.forma_carrito.elements['valorunitario[]'][i].value;
							if(idproducto!="" && cantidad>0 ){
									ruta="modulos/validaciones/adicionar.wear.php?idproducto="+idproducto
									ruta=ruta+"&idcolor="+idcolor+"&idtalla="+idtalla+"&idcant="+cantidad+"&dscodigodis="+dscodigodis;
									ruta=ruta+"&idcate="+idcat+"&idsub="+idsub;
								    conexion1x=AjaxObj()
								    conexion1x.open("POST",ruta,true);
								    conexion1x.onreadystatechange =function() {
								    if (conexion1x.readyState==4) {
								        var _resultado = conexion1x.responseText;
								        if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
										if(_resultado==3){
										errorpos=pos;
										}else{
										calcularsubtotal(pos);
										document.getElementById("img_"+pos).style.display="";
										document.getElementById("unidid_dis_"+pos).innerHTML=(unidadesdispo-cantidad);//  solo informativo
										
										}

								        } else{

								        alert("Error Auto Guardado ! ")		
								       

								        }
								        } // fin conexion1x
								      } // fin funcion conexion1x interna
								      conexion1x.send(null) // limpia conexion    
								}//( fin if )
				

				}	// fin if cantdidad



				}else{
				errorpos=pos;
				}


				}// fin if  pos//



				if(errorpos!=[i]){
				document.getElementById("tr_"+[i]).style.display="none";
				}else{
				document.getElementById("tr_"+pos).style.display="";
				document.getElementById("mensaje_error_"+pos).innerHTML=nombreprod+" No Posee Tal Existencia Verifique por favor ingrese un monto inferior";	
				document.forma_carrito.elements['cantidad[]'][i].value=0;
				document.forma_carrito.elements['cantidad[]'][i].focus();

				}
			
			}// fin for 


}


function validar_distribuidorx(){
//alert("entra2")
var total=document.forma_carrito.totalvalor.value
var compara=document.forma_carrito.preciomindistrib.value;
if (total=="" || total==0) {
alert(" \n Seleccione al menos un producto \n ", function () {
});
return;
}
if(eval(document.forma_carrito.totalvalor.value)<=eval(document.forma_carrito.preciomindistrib.value)) {
alert(" \n Su compra mínima  debe ser de :  "+compara+"   \n ", function () {
});
return;
}

location.href="proceso.distribuidor.php";

}



document.onkeydown = function(){ 
if(window.event && window.event.keyCode == 116){ 
window.event.keyCode = 505; 
} 
if(window.event && window.event.keyCode == 505){ 
return false; 
} 
} 
//============================  validacion  que el campo cantidad solo sera numerico==============//
function validacion(){
        tecla = (document.all) ? event.keyCode : event.which; // 2
        if (tecla==8) return true; // backspace
        if (tecla==9) return true; // tab
        if (tecla==37) return true; // izq flecha
        if (tecla==39) return true; // der flecha
        if (tecla==46) return true; // suprimir
        if (tecla==109) return false; // menos
    	if (tecla==110) return false; // punto
        if (tecla==189) return false; // guion
        if (event.ctrlKey && tecla==86) { return true}; //Ctrl v
        if (event.ctrlKey && tecla==67) { return true}; //Ctrl c
        if (event.ctrlKey && tecla==88) { return true}; //Ctrl x
        if (tecla>=96 && tecla<=105) { return true;} //numpad
        patron = /[0-9]/; // patron
        te = String.fromCharCode(tecla); 
        return patron.test(te); // prueba
}

//==========================FIN VALIDACION=========================================================//
function totales(){
	//alert("entra1")
	// vector valor
	var total=0;
	var subtotal=0;
	var subtotalx=0;
	var totalbaseiva=0;
	var tdescuento=0;
	var iva=0;
	var ivax=0;
	var tflete=0;
	var descuento=0;
	var tiva=0
	for (i=0;i<document.forma_carrito.elements['cantidad[]'].length;i++){
			var y=document.forma_carrito.elements['cantidad[]'][i].value;
			var d=document.forma_carrito.elements['dsdescuento[]'][i].value;
			var f=document.forma_carrito.elements['dsflete[]'][i].value;
			var x=document.forma_carrito.elements['valorunitario[]'][i].value;
			var s=document.forma_carrito.elements['valorneto[]'][i].value;
			var iv=document.forma_carrito.elements['dsiva[]'][i].value;
			if (x=="") x=0;

	if (y>0 ) {

			var z=(parseFloat(x)*parseFloat(y));
			document.forma_carrito.elements['total[]'][i].value=redondear(z);
			tdescuento=eval(tdescuento)+(eval(y)*eval(d));
			subtotalx=eval(subtotalx)+(eval(y)*eval(s));
			tflete=eval(tflete)+(eval(y)*eval(f));
			tiva=eval(tiva)+(eval(y)*eval(iv));
			subtotal=subtotal+z;

	}



		}
	totalx=(eval(redondear(subtotal-descuento)));
	document.forma_carrito.totalvalor.value=redondear(totalx);
	document.getElementById('ptotal').innerHTML=redondear(totalx);
	document.getElementById('total_descunto').innerHTML=tdescuento;
	document.getElementById('total_iva').innerHTML=tiva;
	document.getElementById('subtotal_t').innerHTML=subtotalx;
	document.getElementById('total_flete').innerHTML=tflete;


	//===============CALCULO DE PUNTO=============================//

	var punto=document.getElementById('punto');
	var valorp=document.getElementById('valorp');
	if(punto){
	puntosx=punto.value;
	}
	if(valorp){
	valorpx=valorp.value;
	}
	if(puntosx!="" && valorpx!=""){
	redirp=eval(totalx)/eval(valorpx);
	redirp=redondear(eval(redirp)*eval(puntosx));
	document.getElementById('puntos_redimir').innerHTML=redirp;
	document.forma_carrito.puntos.value=redirp;
	}

	//=============== FIN CALCULO DE PUNTO==========================//



}
</SCRIPT>
<?
function cargar_cantidad($idprox,$idcolorx,$idtallax,$idcat,$idsubc){
global $db;
$sql=" select id,idcant";
$sql.="  from ecommerce_tbltemporalcompras";
$sql.="  where  dsfecha='".$_SESSION['dsfechacompra_dis'];
$sql.="'  and idcliente='".$_SESSION['idcomprador_dis'];
$sql.="'  and idproducto=$idprox and idcolor='$idcolorx' and idtalla='$idtallax'";
$sql.="  and idsubc=$idsubc and idcate='$idcat' ";
$r_delete=$db->Execute($sql);
if(!$r_delete->EOF){
$idcant=$r_delete->fields[1];
}else{
$idcant=0;
}
$r_delete->Close();

return $idcant;

}

?>