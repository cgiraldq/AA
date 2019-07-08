<article class="cont_txt">

	<h1>MAPA DEL SITIO</h1>

<article class="bloque_texto">

	<nav class="mapa_sitio">
		<?$tabla=$prefix."tblpaginas";
		$sql="select a.id,a.dsm,a.dstit,a.idpos,a.idactivo,a.idtienda,a.dsmalterna,idsitemap from $tabla a where idsitemap=3 and idactivo not in (2,9)";
		//echo $sql;
		 $result=$db->Execute($sql);
  		if(!$result->EOF){
  			while(!$result->EOF){

		      $id=$result->fields[0];
		      $dsm=$result->fields[1];
		      $dstit=reemplazar($result->fields[2]);		      
		      ?>
		<article>
			<ul>
				<a href="<?echo $dsm?>"><h2><? echo $dstit?></h2></a>

		<?
		$sqlx="select a.id,a.dsm,a.dstit,a.idpos,a.idactivo,a.idtienda,a.dsmalterna,a.idsitemap,b.id,b.idorigen,b.iddestino ";
		$sqlx.=" from $tabla a , tblpaginasxtblpaginas b where a.id=b.idorigen and b.iddestino=$id and idactivo not in (2,9)";
		//echo $sqlx;
		 $resultx=$db->Execute($sqlx);
  		if(!$resultx->EOF){
  		while(!$resultx->EOF){
  		$idx=$resultx->fields[0];
		$dsmx=$resultx->fields[1];
		$dstitx=reemplazar($resultx->fields[2]);		      
		?>
		<a href="<?echo $dsmx?>"><li><? echo $dstitx?></li></a>
		 <?
	    $resultx->Movenext();
	    }
	    }
  		$resultx->Close();
	    ?>
















			</ul>
		</article>


			 	<?
		        $result->Movenext();# Fin while Consulta Pagina Principal
		     	 }
		      	 }
  				$result->Close();# Fin Consulta Pagina Principal
		      ?>


		

	</nav>

</article>

</article>