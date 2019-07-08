<article class="cont_qsomos" <?if ($pag=="registro.paso.3.php") {echo 'style="display:none;" id="id_term_condiciones"';}?>>
	<article class="txt_terminos">
  <?
  $sql="select dsm,dsd ";
  $sql.="from ecommerce_tblterminos where 1 ";

  if($enca==1)$sql.=" and idasoc=1 ";#Terminos Y Condiciones Generales
  if($enca==2)$sql.=" and idasoc=2 ";#terminos y Condiciones Registro
  if($enca==3)$sql.=" and idasoc=3 ";#Terminos Y Condiciones Compra
  if($enca==4)$sql.=" and idasoc=4 ";#Terminos Y Condiciones Contacto
  $sql.="  and idactivo not in (9)";
  //echo $sql;
  $resultx=$db->Execute($sql);
  if(!$resultx->EOF){
    $dsm=reemplazar($resultx->fields[0]);
    $dsd=reemplazar($resultx->fields[1]);
    $dsd=preg_replace("/\n/","<br>",$dsd);
    ?>
    <h1><?echo $dsm?></h1>
    <p><? echo $dsd?></p>
    <?
    }
    $resultx->Close();
    ?>
  	</article>
</article>