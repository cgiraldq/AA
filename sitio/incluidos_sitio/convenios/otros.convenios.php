<article class="cont_txt">
	<article class="cont_relacionado">
		<h1>Otros convenios</h1>
<?

$dsnombre=$_REQUEST["dsnombre"];

$evento=seldato("id","dsruta","tblconvenios",$dsnombre,2);
$cat=seldato("iddestino","idorigen","tblconveniosxcategoria",$evento,2);

   $id=$_REQUEST["id"];
  $sql="select a.id,a.dsm,a.dsd,a.dsimg,a.dsruta from $dstabla a, tblconveniosxcategoria b where b.idorigen=a.id  ";
  if($dsnombre<>"") $sql.=" and b.iddestino='$cat' ";

  $sql.=" and a.idactivo not in(2,9) group by a.dsm";
  //echo $sql;
   $maxregistros=12;
      $limitemostra=3;
      include($rut."incluidos_sitio/paginar_variables.php");
       $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);

  if(!$result->EOF){
?>
		<ul>
<?

  while(!$result->EOF){

  $id=$result->fields[0];
  $dsm=reemplazar($result->fields[1]);
  $dsd=reemplazar($result->fields[2]);
  $dsd2=reemplazar(preg_replace("/\n/","<br>",$dsd));
  $dsimg=$result->fields[3];
  $dsruta=$result->fields[4];
  $dsrutax=$rutalocal."/convenio_detalle/".$dsruta;
if ($rutaAmiga>1) $dsrutax="$rutadetalle?id=".$id;
?>
			<li>
				<a href="<?echo $dsrutax;?>">
					<article>
						<? //if($dsimg<>""){?>
            <!--img  src="<? echo $rutalocalimag;?>/contenidos/images/qsomos/<? echo $dsimg; ?>"-->
            <?//}?>
						<h2><? echo $dsm;?></h2>
						<!--p><? echo $dsd2;?></p-->
						<div style="clear:both;"></div>
					</article>
				</a>
			</li>

<?
    $result->Movenext();
 }

 ?>

		</ul>
		</article>
<?
  if($totalregistros>$maxregistros)
          {
            $rutaPaginacion=$pagina."?id=".$_REQUEST["id"]."&page=";
             if ($_REQUEST["dsnombre"]<>"") $rutaPaginacion=$_REQUEST["dsnombre"]."&page=";
            include($rut."incluidos_sitio/func.paginador.php");

          }
 }
  $result->Close();
 ?>
	</article>

