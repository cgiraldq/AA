  <? if($dsimgpaginas<>""){?>

        <img src="../../contenidos/images/paginas/<? echo $dsimgpaginas; ?>">

  <?}?>

<article class="blq_txt">
  <h1><? echo reemplazar($dstituloPagina);?></h1>
  <p><? echo reemplazar($dsd2Pagina);?></p>

<?
   $sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsmodo from tblvistabanners a,";
   $sql.=" tblvistaxtblbanners b where a.idactivo='1' and a.id=b.idorigen and b.iddestino='$idpagina' ";
   $sql.=" and $fechaBaseNum between a.idfechai and a.idfechaf ";
    $rutaImagen="../../contenidos/images/banners/";
                $result=$db->Execute($sql);
                if(!$result->EOF){
  ?>
		 <?

            while(!$result->EOF){
             $dsimg=$result->fields[3];
             $dsruta=$result->fields[2];
             $dsmodo=$result->fields[4];

             if ($dsruta<>""){
              $ahref1="<a href='".$dsruta."' target='".$dsmodo."' title='".reemplazar($mensaje)."'>";
                $ahref2="</a>";
              }else{
                $ahref1="";
                $ahref2="";
              }
        ?>
		<li>

			 <? echo $ahref1?>

				<? if($dsimg<>"" && is_file($rutaImagen.$dsimg)){?>
        <img src="<? echo $dsimg;?>" class="block" />
        <?}?>

			 <? echo $ahref2?>
		</li>
		 <?
            $result->MoveNext();
            } // fin while
          ?>
<?
}
$result->Close();
?>

</article>