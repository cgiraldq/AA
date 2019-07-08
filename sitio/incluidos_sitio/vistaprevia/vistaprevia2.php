<a name="anclaform"></a>
<article class="bloque_texto">
<?
if ($idx=="") $idx=$_REQUEST['idx'];
?>

<!-- /////////////////////////////////////// inicio del formulario /////////////////////////////////////////////////////// -->
<?

 $sql="select a.id,a.dsm,a.dsr,a.idactivo,a.idtipo,a.iddes,a.iframemap,a.iframemappos,a.iddesplegable,a.idestilo,a.dsmalternativo from framecf_tbltiposformularios a ";
  $sql.="where a.id=$idx ";
//echo $sql;
$result=$db->Execute($sql);
        if(!$result->EOF){ // incio del primer if
        $contador=1;
          while(!$result->EOF){ // inicio del while que recorre los formularios activos de la pagina
            $idformulario=$result->fields[0];
      $dsmx=$result->fields[1];
      $desc=$result->fields[5];
      $iframemap=$result->fields[6];
      $iframemappos=$result->fields[7];
      //$iddesplegable=$result->fields[8];
      $idestilo=$result->fields[9];
      $dsmalternativo=$result->fields[10];
      if ($dsmalternativo<>"") $dsmx=$dsmalternativo;

?>
<? if($idestilo==1) include("incluidos_sitio/formularios/formulario.tipo1.php");?>

<? if($idestilo==2) include("incluidos_sitio/formularios/formulario.tipo2.php");?>

<? if($idestilo==3)  include("incluidos_sitio/formularios/formulario.tipo3.php");?>

<? if($idestilo==4)  include("incluidos_sitio/formularios/formulario.tipo4.php");?>

<? if($idestilo==5)  include("incluidos_sitio/formularios/formulario.tipoplaceholder.php"); ?>

<?
$contador++;
$result->MoveNext();
} // fin recorridos de formularios activos por pagina

} // fin primer if
$result->Close();
?>

</article>
