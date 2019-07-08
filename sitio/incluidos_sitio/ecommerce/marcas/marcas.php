
<?
// listar categorias de la tienda
  $sql="select a.id,a.dsm,a.dsimg,a.dsd from tblmarcas a ";
  $sql.=" where a.idactivo not in (2,9) ";
  $sql.=" order by dsm ";
            $maxregistros=15;
            include("incluidos_modulos/paginar.variables.php");
            $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
            if(!$result->EOF){
      $rutaImagen=$rutaFuenteImagenes."/contenidos/images/marcas/";


?>


<article class="cont_qsomos">

	<article class="txt_qsomos">
	           <!--h1>MARCAS</h1-->
  </article>



      <?
          $contar=0;
            while (!$result->EOF && ($contar<$maxregistros)) {
      $idm=$result->fields[0];
      $dsm=reemplazar($result->fields[1]);
      $dsimg1=$result->fields[2];
      $dsd=reemplazar(preg_replace("/\n/","<br>",$result->fields[3]));
?>
  <article class="cont_marcas">
      <? if ($dsimg1<>""){?>
        <a href="buscador.php?dsbusqueda=<? echo $dsm?>" title="Click para buscar productos asociados a <? echo $dsm?>">
          <img src="<? echo $rutaImagen.$dsimg1?>" alt="">
        </a>
      <?}?>
      <article>
          <h2><a href="buscador.php?dsbusqueda=<? echo $dsm?>" title="Click para buscar productos asociados a <? echo $dsm?>"><? echo $dsm?></a></h2>
      </article>
  </article>

    <?
        $contar++;

        $result->MoveNext();
        }

    ?>


  <?  include("incluidos_modulos/index.paginar.php");?>
</article>


<?
// fin listar lkas categorias de la tienda
      }
      $resultx->Close();

?>
