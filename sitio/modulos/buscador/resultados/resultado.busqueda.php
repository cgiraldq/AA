<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla de uso para el ingreso de datos
if($rutx==1) $rutxx="../";

?>

<section class="resultado_busqueda">

  <h1>RESULTADO DE BUSQUEDA : <span><? echo $_REQUEST['param'];?></span></h1>

  <table width="100%">

    <tr >
      <td colspan="2"><h2>RESULTADO</h2></td>
      <td class="campo"><h2>OPCIONES</h2></td>
    </tr>

    <?
      $color=0;
      while (!$result->EOF && ($contar<$maxregistros)) {

      if ($color%2==0){
      $colorx="#ededed";
      } else{
        $colorx="#f7f7f7";
      }
      if ($rutxx.$result->fields[2]<>"") {
        $ruta=$rutxx.$result->fields[2];
       } else {
        $ruta="#";
       }
       $idactivo=$result->fields[7];
    ?>

    <tr bgcolor="<?echo $colorx;?>">
      <td colspan="2"><p><strong><? echo $result->fields[0];?></strong><br><? echo $result->fields[1];?></p></td>
      <td>
        <!--a href=""><p>Detalle</p></a-->
        <? if ($idactivo==2) {?>
          <a href="../../core/core.redir.php?rutaredir=core.formulario&modulo=<? echo $result->fields[0];?>&rutacore=http://www.comprandofacil.com/pide/corehome/"><p>Solicitar</p></a>
        <? } else  {?>
        <a href="<? echo $ruta;?>"><p>Ir al modulo</p></a>
        <? } ?>
      </td>
    </tr>
      <?
      $idmodulo=$result->fields[6];
      // complementario. Si es uno de los modulos tipo 1, que busque a nivel interno sus submodulos
      if ($idactivo==1) {
                $sql="select ";
                $sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id,a.idactivo ";
                $sql.=" from tblmodulos a ";
                $sql.=" where 1  ";
                $sql.=" and a.idactivo=3 and a.idmodulo=$idmodulo ";
                $sql.=" order by a.dsm ASC ";
                $resultx = $db->Execute($sql);
                  if (!$resultx->EOF) {
                      while (!$resultx->EOF) {
                      $idactivox=$resultx->fields[7];    
                        if ($rutxx.$resultx->fields[2]<>"") {
                          $rutax=$rutxx.$resultx->fields[2];
                         } else {
                          $rutax="#";
                         }
      
                ?>

                  <tr bgcolor="<?echo $colorx;?>">
                    <td>&nbsp;</td>

                    <td><p><strong><? echo $resultx->fields[0];?></strong><br><? echo $resultx->fields[1];?></p></td>
                    <td>
                      <!--a href=""><p>Detalle</p></a-->
                      <? if ($idactivox==2) {?>
                        <a href="../../core/core.redir.php?rutaredir=core.formulario&modulo=<? echo $resultx->fields[0];?>&rutacore=http://www.comprandofacil.com/pide/corehome/"><p>Solicitar</p></a>
                      <? } else  {?>
                      <a href="<? echo $rutax;?>"><p>Ir al modulo</p></a>
                      <? } ?>
                    </td>
                  </tr>


                <?




                      $resultx->MoveNext();

                    }


                     }
                      $resultx->Close();
 

      } // fin idactivo=1
      if ($idactivo==3) { // buscar en nivel 4

                $sql="select ";
                $sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id,a.idactivo ";
                $sql.=" from tblmodulos a ";
                $sql.=" where 1  ";
                $sql.=" and a.idactivo=4 and a.idsubmodulo=$idmodulo ";
                $sql.=" order by a.dsm ASC ";
                $resultx = $db->Execute($sql);
                  if (!$resultx->EOF) {
                      while (!$resultx->EOF) {
                      $idactivox=$resultx->fields[7];    
                        if ($rutxx.$resultx->fields[2]<>"") {
                          $rutax=$rutxx.$resultx->fields[2];
                         } else {
                          $rutax="#";
                         }
      
                ?>

                  <tr bgcolor="<?echo $colorx;?>">
                    <td>&nbsp;</td>

                    <td><p><strong><? echo $resultx->fields[0];?></strong><br><? echo $resultx->fields[1];?></p></td>
                    <td>
                      <!--a href=""><p>Detalle</p></a-->
                      <? if ($idactivox==2) {?>
                        <a href="../../core/core.redir.php?rutaredir=core.formulario&modulo=<? echo $resultx->fields[0];?>&rutacore=http://www.comprandofacil.com/pide/corehome/"><p>Solicitar</p></a>
                      <? } else  {?>
                      <a href="<? echo $rutax;?>"><p>Ir al modulo</p></a>
                      <? } ?>
                    </td>
                  </tr>


                <?




                      $resultx->MoveNext();

                    }


                     }
                      $resultx->Close();




      } // fin idactivo=3



      $color++;
      $result->MoveNext();

    }
    $result->Close();

    ?>

  </table>

</section>
