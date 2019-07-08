<a name="anclaform"></a>
<article class="bloque_texto">
<?
if ($idx=="") $idx=$_REQUEST['idx'];

 $sql="select a.id,a.dsm,a.iddesplegable,a.dsmalternativo,idactivartitulo,idactivardsd from framecf_tbltiposformularios a,tblpaginasxtblformularios b ";
 $sql.="where (a.id=b.iddestino) and a.idactivo=1 and  b.idorigen=$idpagina   and a.iddesplegable=1 and a.idpublicar=1";
//echo $sql;
$result=$db->Execute($sql);
        if(!$result->EOF){ // incio del primer if
          $contform=$result->RecordCount();
          $contador=1;
 ?>

    <ul class="tabs">
 <?
        	while(!$result->EOF){ // inicio del while que recorre los formularios activos de la pagina
            $idactivartitulo=$result->fields[4];
            $idactivardsd=$result->fields[5];
            $idformulario=$result->fields[0];
			     if($idactivartitulo==1) $dsmx=$result->fields[1];
            $iddesplegable=$result->fields[2];
            $dsmalternativo=$result->fields[3];



            if ($dsmalternativo<>"" && $idactivartitulo==1) $dsmx=$dsmalternativo;

?>
      <li>
        <a href="#anclaform" class="btn_color2" onclick="abrir_forma('frm_<? echo $contador;?>','<? echo $contform;?>','frm_');">
        	<p>x<? echo $dsmx;?></p>
        </a>
      </li>
<?
$contador++;
$result->MoveNext();
} // fin recorridos de formularios activos por pagina
?>
 </ul>

<?

} // fin primer if
$result->Close();

?>

<!-- /////////////////////////////////////// inicio del formulario /////////////////////////////////////////////////////// -->
<?
//$db->$debug=true;
$sql="select a.id,a.dsm,a.dsr,a.idactivo,a.idtipo,a.iddes,a.iframemap,a.iframemappos,a.iddesplegable,a.idestilo,a.dsmalternativo,idactivartitulo,idactivardsd,a.idcaptcha,a.idterminos,a.idremate ";//15
$sql.=" from framecf_tbltiposformularios a,tblpaginasxtblformularios b ";
$sql.=" where a.id=b.iddestino and a.idactivo=1 and  b.idorigen=$idpagina and a.idpublicar=1 ";
if($idestadox<>"") {
  $sql.=" and a.idestilo=$idestadox ";
}else{
    $sql.=" and a.idestilo not in (7) ";
}
//echo $sql;
$result=$db->Execute($sql);
        if(!$result->EOF){ // incio del primer if
        $contador=1;
          while(!$result->EOF){ // inicio del while que recorre los formularios activos de la pagina

        $idactivartitulo=$result->fields[11];
        $idactivardsd=$result->fields[12];

            $idformulario=$result->fields[0];

      if($idactivartitulo==1){
        $dsmx=$result->fields[1];
        $desc=$result->fields[5];
      }else{
        $dsmx=reemplazar($dstituloPagina);
        $desc=reemplazar($dsd2Pagina);
      }

      $iframemap=$result->fields[6];
      $iframemappos=$result->fields[7];
      $iddesplegable=$result->fields[8];
      $idestilo=$result->fields[9];
      $dsmalternativo=$result->fields[10];

      $idcaptcha=$result->fields[13];
      $idterminos=$result->fields[14];
      $idremate=$result->fields[15];



      if ($dsmalternativo<>"" &&  $idactivartitulo==1) $dsmx=reemplazar($dsmalternativo);
?>
<?

if ($menulateral<>"") {
   include("incluidos_sitio/formularios/formulario.tipo6.php");
} else {
if($idestilo==1) include("incluidos_sitio/formularios/formulario.tipo1.php");
if($idestilo==2) include("incluidos_sitio/formularios/formulario.tipo2.php");
if($idestilo==3)  include("incluidos_sitio/formularios/formulario.tipo3.php");
if($idestilo==4)  include("incluidos_sitio/formularios/formulario.tipo4.php");
if($idestilo==5)  include("incluidos_sitio/formularios/formulario.tipoplaceholder.php");
if($idestilo==7)  include("incluidos_sitio/formularios/formulario.tipo7.php");// footer

}

$contador++;
$result->MoveNext();
} // fin recorridos de formularios activos por pagina

} // fin primer if
$result->Close();
?>

</article>
