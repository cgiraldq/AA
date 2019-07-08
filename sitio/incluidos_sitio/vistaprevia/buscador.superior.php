<a name="anclaform"></a>
<article class="bloque_texto">
<?
if ($idx=="") $idx=104;

 $sql="select a.id,a.dsm from framecf_tbltiposformulariosxcampos  a ";
 $sql.="where  a.idactivo=1 and a.idtipoformulario=$idx  and a.idcampo=290 order by a.idpos";
  echo $sql;
$result=$db->Execute($sql);
        if(!$result->EOF){ // incio del primer if

          $contform=$result->RecordCount();
        	   while(!$result->EOF){ // inicio del while que recorre los formularios activos de la pagina
                $idformulario=$idx;
    			      $dsmx=$result->fields[1];
                $vidformulario[]=$result->fields[0];
                $vdsmx[]=$result->fields[1];
                $viddesplegable[]=$result->fields[2];
                $iddesplegable=1;

$result->MoveNext();
} // fin recorridos de formularios activos por pagina
?>
 </ul>
<?

} // fin primer if
$result->Close();

for ($i=1;$i<=count($vdsmx);$i++) {

 $nombre=$vdsmx[$i];

  Include("incluidos_sitio/formularios/formulario.tipo5.php");

}
?>

</article>
