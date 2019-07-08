<?

// extraer datos de remate
        $sql="select id,dsdireccion,dstelefono,dsimg1,dsemail,dsciudad from tblremate where idactivo=1";
        //    echo $sql;
        $resultmap=$db->Execute($sql);
        if(!$resultmap->EOF){
		$id=reemplazar($resultmap->fields[0]);
		$dsdireccion=reemplazar($resultmap->fields[1]);
		$dsimg1=($resultmap->fields[3]);
		$dstelefono=reemplazar($resultmap->fields[2]);

		$dsemail=reemplazar($resultmap->fields[4]);
		$dsciudad=reemplazar($resultmap->fields[5]);

?>
<div class="datos_contacto">

<article class="texto_contacto">	
<p><? echo $dsciudad;?></p>
<p><? echo $dsdireccion;?></p>
<p>+57 (4) <? echo $dstelefono;?></p>
<p><? echo $dsemail;?></p>
</article>
<article class="logo_contacto">
<? if($dsimg1<>""){?>
<img src="../contenidos/images/remate/<? echo $dsimg1;?>" alt="">
<?}?>
</article>
</div>
<?
	}
	$resultmap->Close();

?>