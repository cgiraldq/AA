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

<article class="blq_modulos">

  <ul>

<?
      $color=0;
      while (!$result->EOF && ($contar<$maxregistros)) {
      $color++;
      if ($color==4) $color=1;
      // totales de modulos activos
      $modulosactivos=0;
      $modulosinactivos=0;
      $dsm="";
      $dsr="";

      $dsmd="";
      $dsrd="";


      $idmodulo=$result->fields[6];
            $sql="select ";
            $sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id,a.idactivo ";
            $sql.=" from tblmodulos a ";
            $sql.=" where 1  ";
            $sql.=" and a.idactivo=3 and a.idmodulo=$idmodulo ";
            $sql.=" order by a.dsm ASC ";
            $resultx = $db->Execute($sql);
            if (!$resultx->EOF) {
                while (!$resultx->EOF) {
                    $modulosactivos++;
                    $idsubmodulo=$resultx->fields[6];
                    $dsm[]=$resultx->fields[0];
                    $dsr[]=$resultx->fields[2];

                        $sql="select ";
                        $sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id,a.idactivo ";
                        $sql.=" from tblmodulos a ";
                        $sql.=" where 1  ";
                        $sql.=" and a.idactivo=4 and a.idsubmodulo=$idsubmodulo ";
                        $sql.=" order by a.dsm ASC ";
                        $resulty = $db->Execute($sql);
                          if (!$resulty->EOF) {
                              while (!$resulty->EOF) {
                                  $modulosactivos++;
                                  $resulty->MoveNext();

                              }
                          }
                          $resulty->Close();
                                   


                    $resultx->MoveNext();

                  }
                }
            $resultx->Close();
//inactivos
            $sql="select ";
            $sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id,a.idactivo ";
            $sql.=" from tblmodulos a ";
            $sql.=" where 1  ";
            $sql.=" and a.idactivo=2 and a.idmodulo=$idmodulo ";
            $sql.=" order by a.dsm ASC ";
            $resultx = $db->Execute($sql);
            if (!$resultx->EOF) {
                while (!$resultx->EOF) {
                    $modulosinactivos++;
                    $idsubmodulo=$resultx->fields[6];
                    $dsmd[]=$resultx->fields[0];
                    $dsrd[]=$resultx->fields[2];

                        $sql="select ";
                        $sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla,a.id,a.idactivo ";
                        $sql.=" from tblmodulos a ";
                        $sql.=" where 1  ";
                        $sql.=" and a.idactivo=2 and a.idsubmodulo=$idsubmodulo ";
                        $sql.=" order by a.dsm ASC ";
                        $resulty = $db->Execute($sql);
                          if (!$resulty->EOF) {
                              while (!$resulty->EOF) {
                                  $modulosinactivos++;
                                  $resulty->MoveNext();

                              }
                          }
                          $resulty->Close();
                                   


                    $resultx->MoveNext();

                  }
                }
            $resultx->Close();



?>

    <li>

      <h1 class="txt<? echo $color?>"><? echo $result->fields[0];?></h1>


      <article>
        <div class="titu_modulos">
          <img src="http://www.comprandofacil.com/pide/corehome/img_modulos/modulo_disponible.png">
          Modulos activos
          <span><? echo $modulosactivos?></span>
        </div>
        <ul class="list_modulos">
          <? if (count($dsm>0)) {
              for ($i=0;$i<count($dsm);$i++) {
                  if (($rutxx.$dsr[$i])<>"") {
                  $rutax=$rutxx.$dsr[$i];
                 } else {
                  $rutax="#";
                 }

            ?>
          <li><a href="<? echo $rutax?>"><p><? echo $dsm[$i]?></p></a></li>
          <? 
              }
          } ?>
        </ul>
      </article>


      <article>
        <div class="titu_modulos">
          <img src="http://www.comprandofacil.com/pide/corehome/img_modulos/modulo_disponible.png">
          Modulos disponibles
          <span><? echo $modulosinactivos;?></span>
        </div>
        <ul class="list_modulos">
          <? if (count($dsmd>0)) {
              for ($i=0;$i<count($dsmd);$i++) {
            ?>
          <li><a href="../../core/core.redir.php?rutaredir=core.formulario&modulo=<? echo $dsmd[$i];?>&rutacore=http://www.comprandofacil.com/pide/corehome/"><p><? echo $dsmd[$i]?></p></a></li>
          <? 
              }
          } ?>

        </ul>
      </article>
<?
// preguntar por CURL si funciona
// traer la primera posicion el total de nuevos modulos por tipo de seccion
// las otras posiciones traen el nombre para solicitar el modulo
$var=file_get_contents("http://www.comprandofacil.com/pide/corehome/core.modulos.nuevos.php?codcliente=".$codcliente."&dsmodulo=".$result->fields[0]);
$partir=explode("|",$var);
$nuevosmodulos=$partir[0];
?>

      <article>
        <div class="titu_modulos">
          <img src="http://www.comprandofacil.com/pide/corehome/img_modulos/modulo_nuevo.png">
          Modulos nuevos
          <span><? echo $nuevosmodulos?></span>
        </div>

        <ul class="list_modulos">
          <? if (count($partir>0)) {
              for ($i=1;$i<count($partir);$i++) {

          ?>  
          <li><a href=""><p><? echo $partir[$i]?></p></a></li>
          <? 
            }
        } ?>
        </ul>
      </article>


    </li>
<?

      $result->MoveNext();

    }
    $result->Close();

    ?>

  </ul>

</article>