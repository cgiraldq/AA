<article class="cont_tab_ecommerce_detalle" id="calcularenvio" style="display:none;">

	<article class="cont_frm_calcular">
	<form name="forma_carrito">
		<fieldset>
			<label for="dstipoidentificacion">Ciudad:</label>
			<div>
          <select name="dsciudadenvio" id="dsciudadenvio" onchange="cambiar_transporte_detalle_producto('forma_carrito')"  >
              <option value="">Seleccione</option>
        <?
            $sqlx="select id,dsciudad,idvalor,dsdep,idtarifa  ";
            $sqlx.=" from ecommerce_tblfletes where id>0  order by idpos asc,dsciudad asc";
          //  echo $sqlx;
            $resultx= $db->Execute($sqlx);
            if (!$resultx->EOF) {
            while(!$resultx->EOF){
            $id=$resultx->fields[0];
           $dsciudad=reemplazar($resultx->fields[1]);
             $idvalor=$resultx->fields[2];
             $dsdep=$resultx->fields[3];
             $idtarifa=$resultx->fields[4];


            ?>
              <option value="<? echo $dsciudad." - ".$dsdep ?>|<? echo $idtarifa; ?>|<? echo $idvalor; ?>" <? if ($dsciudadenvio==$dsciudad) echo "selected"?>><? echo $dsciudad." - ".$dsdep; ?></option>
                <?
                    $resultx->MoveNext();
                    }
                ?>
<?
                              }
                    $resultx->Close();
?>
            </select>

			</div>
		</fieldset>
	</form>
</article>

	<article class="envio" id="txt_dsciudadenvio">
		<h2>Valor de envio: <span id="txt_valorenvio"></span></h2>
	</article>
</article>

<script language="javascript">
<!--
function cambiar_transporte_detalle_producto(forma){
    document.getElementById('txt_dsciudadenvio').style.display="none";
    document.getElementById('txt_valorenvio').style.display="none";
     var formabase=eval("document."+forma);
    if (formabase.dsciudadenvio.value!=""){
    partir=formabase.dsciudadenvio.value.split("|");
    idtipoenvio=partir[1];
    idvalor=partir[2];

	document.getElementById('txt_valorenvio').innerHTML="$ "+idvalor;
    document.getElementById('txt_dsciudadenvio').style.display="";
    document.getElementById('txt_valorenvio').style.display="";
    }
}
//-->
</script>
