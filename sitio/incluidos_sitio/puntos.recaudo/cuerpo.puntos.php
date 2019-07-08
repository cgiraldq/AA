<a name="inicio"></a>


	<h1>PUNTOS DE RECAUDO</h1>


     <?//include("incluidos_sitio/oficinas/oficinas.menu.php");?>
<div class="contenido">

 <?
        $sql="select a.dsm,a.dsd,a.dsdireccion,a.dstelefono,a.dslongitud,a.dslatitud,a.dszoom,a.id,a.dsruta ";
      $sql.=" from tbloficina a inner join tblciudades b on a.idc=b.id where a.idactivo not in (2,9) and b.idactivo not in (2,9) order by b.idpos,a.idpos asc";
      $result=$db->Execute($sql);
      if(!$result->EOF){
      ?>
         <?
          $con=1;
          while(!$result->EOF){
          $dsm=reemplazar($result->fields[0]);
      $dsd=reemplazar($result->fields[1]);
      $dsdireccion=reemplazar($result->fields[2]);
      $dstelefono=reemplazar($result->fields[3]);
      $dslongitud=$result->fields[4];
      $dslatitud=$result->fields[5];
      $dszoom=$result->fields[6];
      $id=$result->fields[7];
      $dsruta=$result->fields[8];
      $cadenadatos=$dslatitud."|".$dslongitud."|".$dszoom."|".$dsm."|".$dsd."|".$dstelefono."|".$dsdireccion;
      //if(trim($dslatitud)<>"" && trim($dslongitud)<>"" && trim($dszoom)<>""){
       $dsrutax=$rutalocal."/mis_oficinas/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="oficinas.php?id=".$idoficina;
         ?>
         <div id="capa_datos<? echo $con?>" style="display:none"><? echo $cadenadatos?></div>
         <?
          //}
          $con++;
          $result->MoveNext();
          }
         ?>

         <?
          }$result->Close();
?>


	<?
		$sql="select a.dsm,a.dsd,a.dsdireccion,a.dscorreo,a.dstelefono,a.dsimg,a.dsimg2,a.idactivo,a.dslongitud,a.dslatitud,a.dszoom,b.id,b.dsm,a.id,b.dsimg,b.dsd ";
		$sql.=" from tbloficina a inner join tblciudades b on a.idc=b.id where a.idactivo not in (2,9) and b.idactivo not in (2,9) order by b.idpos,a.idpos asc";
		$result=$db->Execute($sql);
		if(!$result->EOF){
		$con=1;
		$i=1;
		$cantoficinas=$result->RecordCount();
		 $rutaImagen=$rutalocalimag."/contenidos/images/oficina/";
		while(!$result->EOF){
		$id=$result->fields[11];
		$dsciudad=$result->fields[12];
		$dsimg=$result->fields[14];
		$dsdciudad=$result->fields[15];
		$a=explode(" ",$dsciudad);
		?>
			<a name="<? echo $a[0]?>"></a>
			<div class="red_oficinas">
				<? if($dsimg){?><img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>"> <?}?>
				<h3><? echo $dsciudad?></h3>
				<p><? echo reemplazar($dsdciudad);?></p>
				<a id="link<? echo $i?>" class="ver_mas3" href="javascript:mostrarcapa('oficinas','<? echo $i?>','<? echo $cantoficinas?>');ocutarlink('link','<? echo $i?>','<? echo $cantoficinas?>','<? echo $a[0]?>')">
					<p>Ver m&aacute;s</p>
				</a>

				<a style="display:none" class="ver_mas3" id="cerrar<? echo $i?>" href="javascript:ocultarcapa('oficinas','<? echo $i?>','<? echo $cantoficinas?>','link','<? echo $i?>');">
					<p>Cerrar</p>
				</a>
			</div>
				<div id="oficinas<? echo $i?>" class="red_oficinas_lista" style="display:none">
		<?
		while(!$result->EOF && $id==$result->fields[11]){
		$dsm=reemplazar($result->fields[0]);
		$dsd=reemplazar($result->fields[1]);
		$dsdireccion=reemplazar($result->fields[2]);
		$dscorreo=$result->fields[3];
		$dstelefono=reemplazar($result->fields[4]);
		$dsimg=$result->fields[5];
		$dslongitud=$result->fields[8];
		$dslatitud=$result->fields[9];
		$dszoom=$result->fields[10];
		$idoficina=$result->fields[13];
		$ejecurar=0;
		$oficina=limpieza(strtolower($dsm));
		if($idoficina==$_REQUEST['id']){
			$ejecutar=$i;
			$linkoficina=$oficina;
		}
	?>
	<a name="<? echo $oficina?>"></a>
	<article>
		<?

		if(!is_file($rutaImagen.$dsimg)){?>
		<img src="<? echo $rutaImagen.$dsimg?>" />
		<? }?>
		<h3 ><? echo $dsm?><? if($dslongitud<>"" && $dslatitud<>"" && $dszoom<>""){?></h3>
		<? if($dsdireccion<>""){?><p><strong>Direcci&oacute;n:</strong><? echo $dsdireccion?></p><? }?>
		<? if($dstelefono<>""){?><p><strong>Tel&eacute;fonos:</strong><? echo $dstelefono?></p><? }?>
		<? if($dscorreo<>""){?><p><strong>Correo:</strong> <? echo $dscorreo?></p><? }?>
		<? if($dsd<>""){?><p><strong>Horarios de Atenci&oacute;n:</strong> <? echo $dsd?></p><? }?>
		<div>
			<img onclick="mostrarmapa('<? echo $con?>')"  src="<? echo $rutalocal;?>/images/icono_mapa.png"><? }?>
		</div>
	</article>

	<?
			$con++;
			$id=$result->fields[11];
			$result->MoveNext();
		}
	?>
	</div>
	<div style="height:5px;"></div>
	<?
		$i++;
		}
		}$result->Close();
	?>

</div>

<? if($pagina=="oficinas.php")include("mapa.php");?>

<? if($ejecutar<>0){?>
<script language="javascript">
//alert('<? echo $ejecutar?>');
mostrarcapa('oficinas','<? echo $ejecutar?>','<? echo $cantoficinas?>');
ocutarlink('link','<? echo $ejecutar?>','<? echo $cantoficinas?>','<? echo $linkoficina?>')
</script>
<? }?>
