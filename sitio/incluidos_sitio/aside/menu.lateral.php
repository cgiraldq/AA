<?
$dsnombre=$_REQUEST["dsnombre"];
$idm=$_REQUEST["id"];
  if($pag=="servicios.detalle.php"){
    $sql="select a.id,a.dsm from tblcategoria a where idactivo=1 and dsruta!='$dsnombre' order by a.dsm asc";
  }


  if($pag=="productos.detalle.php"){
    $sql="select a.id,a.dsm from tblproductos a where idactivo=1 and dsruta!='$dsnombre' order by a.dsm asc";
  }
  if($pag=="experiencia.detalle.php"){
    $sql="select a.id,a.dsm from tblexperiencia a where idactivo=1 and dsruta!='$dsnombre' order by a.dsm asc";
  }

   if($pag=="galeria2.detalle.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblgaleria2 a where idactivo=1  order by a.dsm asc";
//echo $sql;
    $ruta="subcategoria_galerias";
  }

  if($pag=="galeria2.subcategoria.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblgaleria2 a where idactivo=1  order by a.dsm asc";
//echo $sql;
    $ruta="subcategoria_galerias";
  }

   if($pag=="convenios.detalle.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblconvenios a where idactivo=4  order by a.dsm asc";
      $ruta="convenio_detalle";
  }

  if($pag=="fundacion.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblfundacion a where idactivo=4  order by a.dsm asc";
    //echo $sql;
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
    $ruta="mis_fundaciones";
  }

   if($pag=="asociados.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblasociados a where idactivo=4  order by a.dsm asc";
    //echo $sql;
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
    $ruta="mis_asociados";
  }

  if($pag=="noticia.detalle.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblnoticias a where idactivo not in(2,9)  order by a.dsm asc";
    //echo $sql;
   $ruta="mis_noticias";
  }

  if($pag=="asociados.detalle.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblasociados a where idactivo in(1,4)  order by a.dsm asc";
    //echo $sql;
   $ruta="mis_asociados";
  }

  if($pag=="fundacion.detalle.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblfundacion a where idactivo=4  order by a.dsm asc";
    //echo $sql;
   $ruta="mis_fundaciones";
  }

   if($pag=="qsomos.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblqsomos a where idactivo=4  order by a.idpos asc";
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
     $ruta="quienes_somos";
  }

  if($pag=="qsomos.detalle.php"){
    $sql="select a.id,a.dsm,a.dsruta from tblqsomos a where idactivo in(1,4) order by a.idpos asc   ";
     //if($id<>"") $sql.=" and id!=$id";
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
     $ruta="quienes_somos";
  }

  if($pag=="seguridad.internet.php"){
    $sql="select a.id,a.dsm,a.dsruta,dstitulo from $dstabla a where idactivo in(1,4) order by a.idpos asc   ";
     //if($id<>"") $sql.=" and id!=$id";
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
     $ruta="seguridad_internet";
  }

  if($pag=="hacemos.php"){
    $sql="select a.id,a.dsm,a.dsruta,dstitulo from $dstabla a where idactivo in(1,4) order by a.idpos asc   ";
     //if($id<>"") $sql.=" and id!=$id";
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
     $ruta="lo_que_hacemos";
  }

  if($pag=="sonamos.php"){
    $sql="select a.id,a.dsm,a.dsruta,dstitulo from $dstabla a where idactivo in(1,4) order by a.idpos asc   ";
     //if($id<>"") $sql.=" and id!=$id";
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
     $ruta="lo_que_sonamos";
  }

  if($pag=="eventos.detalle.php"){
    $sql="select a.id,a.dsm,a.dsruta from tbleventos a where idactivo not in(2,9) ";
     //if($id<>"") $sql.=" and id!=$id";
     $sql.=" order by a.dsm asc";
   //if($dsnombre<>"")$sql.="and dsruta!='$dsnombre'";
     $ruta="mis_eventos";
  }
  //echo $sql;
  $result=$db->Execute($sql);
  if(!$result->EOF){
?>
<nav class="menu_lateral">
	<div class="titulo_aside">
  <h2>Menú</h2>
  </div>
<?

  	 while(!$result->EOF){

  $id=$result->fields[0];
  $dsm=$result->fields[1];

  $dsruta=$result->fields[2];
  $dstitulo=$result->fields[3];
  if($dstitulo<>"")$dsm=$result->fields[3];

      $dsrutax=$rutalocal."/$ruta/".$dsruta;
        if ($rutaAmiga>1) $dsrutax="$rutalocal/".$rutadetalle."?id=".$id;

?>
	<ul>

		<li>
      <a href="<? echo $dsrutax;?>">
        <p <? if($id==$idm){ echo "style='color:#94C51F '"; }?>><? echo reemplazar($dsm);?>
        </p>
      </a>
    </li>

	</ul>
<?
   $result->Movenext();
 }

 ?>
</nav>
<?
}
  $result->Close();
?>