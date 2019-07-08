<?
   $sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsmodo from tblvistabanners a, tblvistaxtblbanners b where a.idactivo='4' and a.id=b.idorigen and b.iddestino='$idpagina' ";
   $sql.=" and $fechaBaseNum between a.idfechai and a.idfechaf ";
   //echo  $sql;
                $result=$db->Execute($sql);
                if(!$result->EOF){
  ?>
<article class="bloques_destacados">
	<ul>
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

				<? if($dsimg<>""){?><img src="../../contenidos/images/banners/<? echo $dsimg;?>" class="block" /><?}?>

			 <? echo $ahref2?>
		</li>
		 <?
            $result->MoveNext();
            } // fin while
          ?>
	</ul>
</article>
<?
}
$result->Close();
?>