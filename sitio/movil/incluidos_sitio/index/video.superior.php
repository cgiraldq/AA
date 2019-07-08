<?
   $sql="select a.id,a.dsm,a.dsruta,a.dsimg,a.dsd from tblvistavideos a,";
   $sql.=" tblvistaxtblvideos b where a.idactivo='1' and a.id=b.idorigen and b.iddestino='$idpagina' ";
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
             $video=$result->fields[4];

        ?>
    <li>

      <div><? echo $video;?></div>

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