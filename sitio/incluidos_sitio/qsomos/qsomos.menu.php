<article class="cont_txt">

    <nav class="cont_botenes">
    <?
     $idm=$_REQUEST["id"];
	  $sql="select dsm,dsd,dsimg,dstitulo,dsruta,id from $dstabla where idactivo=3";
	  //if($id<>"") $sql.=" and id!=$id";
	  $sql.=" order by idpos";
	  $result = $db->Execute($sql);
	  if (!$result->EOF) {

	?>
      <ul>
      	<?  while(!$result->EOF) {

			  $dsm=reemplazar($result->fields[0]);
			  $dsd=trim($result->fields[1]);
			  $dsd=reemplazar($dsd);
			  $dsimg=$result->fields[2];
			  $dstitulo=reemplazar($result->fields[3]);
			  $id=$result->fields[5];
			  if($dstitulo=="")$dstitulo=$dsm;

			 $dsruta=$result->fields[4];
			$dsrutax=$rutalocal."/quienes_somos/".$dsruta;
	  		if ($rutaAmiga>1) $dsrutax="$rutalocal/".$rutadetalle."?id=".$id;
	  		if($id==$idm) $dsrutax="";

			  ?>


        <li>
        	<a href="<? echo $dsrutax; ?>" class="btn_zona">
        		<p <?if($id==$idm){echo ""; }?>><? echo $dstitulo;?></p>
        	</a>
        </li>
		       <?
		       $result->MOveNext();
				}?>
      </ul>

    </nav>
	<?

	}
	$result->Close();
	?>
</article>