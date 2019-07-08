<?
//posicionamiento ofertas de formacion
//echo $idc;
//echo $pag;


	if($rutap<>1) $pag=$pagina;
	$rutaPaginas=$rut."../contenidos/images/paginas/";
	$sql="select dstit,dsd,dskw,dsd2,id,idactivo,dstitulo,dstabla,rutadetalle,dsimg1,bg_color,bg_img from tblpaginas where (dsm='$pag' or dsmalterna='$pag') and idactivo not in(2,9)  ";
	$result = $db->Execute($sql);
	//echo $sql;
	if (!$result->EOF) {

		$dstitulox=reemplazar($result->fields[0]);

		$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		$dsclaves=trim($result->fields[2]);
		$dsd2Pagina=reemplazar($result->fields[3]);
		$dstituloPagina=$result->fields[6];

		$dstabla=$result->fields[7];
		$rutadetalle=$result->fields[8];

		$idpagina=$result->fields[4];
		$idactivo=$result->fields[5];
		$dsmiga=reemplazar($result->fields[0]);
		$dsimgpaginas=$result->fields[9];
		$bg_color=$result->fields[10];
		$bg_img=$result->fields[11];

	}
	$result->Close();

//posicionamiento Noticias
if($dsnombre<>"" &&  $pag=="noticia.detalle.php"){
	$sql="select dsm,dsdp,dskw,dsruta,dsimg,dsd from tblnoticias where dsruta='$dsnombre' and idactivo not in (2,9) ";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {

		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."noticia.detalle.php";
		$title_miga=$title2;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;

	}
	$result->Close();


}

// Fin posicionamiento Noticias

//posicionamiento Noticias


if(($dsnombre<>"" || $id<>"") &&  $pag=="servicios.detalle.php"){
	$sql="select dsm,dsdp,dskw,dsruta,dsimg1,dsd,id from tblservicios where dsruta='$dsnombre' and idactivo not in (2,9) ";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {

		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."novedades.php";
		$title_miga=$title2;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
		$idrelacion=$result->fields[6];

	}
	$result->Close();
}
if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="ecommerce.subcategorias.php"){
	$sql="select dsm,dsdp,dskw,dsruta,dsimg1,dsd,id from ecommerce_tblcategoria where ";
	if($dsnombre<>"") $sql.=" dsruta='$dsnombre' and idactivo not in (2,9) ";
	if($idrelacion<>"")$sql.=" id='$idrelacion' and idactivo not in (2,9) ";
	$result = $db->Execute($sql);
	if (!$result->EOF) {

		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."novedades.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion=$rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
		$idrelacion=$result->fields[6];
		$dsmiga=$title_miga;
	}
	$result->Close();
	
}

if(($dsnombre<>"" || $id<>"") &&  $pag=="qsomos.detalle.php"){
	$sql="select dsm,dsd,dsd,dsruta,dsimg,dsd,id from tblqsomos where dsruta='$dsnombre' and idactivo not in (2,9) ";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {

		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."testimonio.detalle.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/qsomos/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
		$idrelacion=$result->fields[6];

	}
	$result->Close();
}



// Fin posicionamiento Noticias
if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="ecommerce.productos.detalle.php"){

	$sql="select dsm,dsdp,dskw,dsruta,dsimg1,dsd,id from ecommerce_tblproductos where ";
	if($dsnombre<>"") $sql.=" dsruta='$dsnombre' ";
	if($idrelacion<>"")$sql.=" id='$idrelacion' ";

	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=(trim($result->fields[0]));
	    $dstitulox=reemplazar($dstitulox);

	      $dstitulox=htmlspecialchars_decode($dstitulox);
	      $dstitulox=html_entity_decode($dstitulox);

		$dstitulox=utf8_encode($dstitulox);
		$dstitulox=utf8_decode($dstitulox);

		//$dstitulox=htmlspecialchars_decode($dstitulox);
		//$dstitulox=html_entity_decode($dstitulox);
		$dsclaves=$result->fields[2];
		$ruta_miga=$rut."novedades.php";
		$title_miga=$title2;
		if ($dsdescr=="")$dsdescr=trim($result->fields[5]);
        $dsdescr=html_entity_decode($dsdescr);
        $dsdescr=strip_tags($dsdescr);
		$dsdescr=reemplazar($dsdescr);
		$dsdescr=str_replace("&nbsp;","",$dsdescr);

		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/producto/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$idrelacion=$result->fields[6];
	   	
		// carga de imagen
		$sqlimg="select id,dsimg";
		$sqlimg.=" from ecommerce_tblproductoximg where 1";
		$sqlimg.="  and iddestino=$idrelacion order by id asc limit 0,1 ";
		$resultimg = $db->Execute($sqlimg);
		if (!$resultimg->EOF) {
			$dsimg=$resultimg->fields[1];
		}
		$resultimg->Close();
	    

		$rutaimagen_sindicacion = 'http://'.$autorizado.'/contenidos/images/ecommerce_productos/'.trim($dsimg);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	   	if($idrelacion<>"" && $_REQUEST['dscategoriax']==""){
	   	$idcat=$_REQUEST['dscategoria'];
	   	$idsub=$_REQUEST['subcate'];
	   	//$db->debug=true;
	 	$dsmigac=seldato('dsm','id','ecommerce_tblcategoria',$_REQUEST['dscategoria'],1);
	 	$dsmigas=seldato('dsm','id','ecommerce_tblsubcategoriasxcategoria',$_REQUEST['subcate'],1);
	 	//$db->debug=false;
	 	}elseif($_REQUEST['dscategoriax']<>""){
	 	$idcat=$_REQUEST['dscategoriax'];
	 	$idsub=$_REQUEST['subcate'];
	 	$dsmigac=seldato('dsm','dsruta','ecommerce_tblcategoria',$_REQUEST['dscategoriax'],2);
	 	$dsmigas=seldato('dsm','dsruta','ecommerce_tblsubcategoriasxcategoria',$_REQUEST['subcate'],2);
	 	}
	 	$dsmiga="";
	 	$dsmigac=reemplazar($dsmigac);
	 	$dsmigas=reemplazar($dsmigas);
	 	if($dsmigac<>"")$dsmiga.="<a href='ecommerce.subcategorias.php?idrelacion=$idcat'>".$dsmigac."</a>  ";
	 	if($dsmigas<>"")$dsmiga.="<a href='ecommerce.productos.php?idrelacion=$idsub&dscategoria=$idcat'>".$dsmigas."</a>  ";
	 	$dsmiga.="<a >".$dstitulox."</a>";

	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="productos.detalle.php"){
	$partir=explode("/",$dsnombre);
	$sql="select dsm,dsdp,dskw,dsruta,dsimg1,dsd,id from tblcategoria where (dsruta='".$partir[0]."'";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."novedades.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	 	$idrelacion=$result->fields[6];

	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="productos.php"){

	$sql="select dsm,dsdp,dskw,dsruta,dsimg1,dsd,id from tblcategoria where (dsruta='$dsnombre'";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
	//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."novedades.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/productos/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	 	$idrelacion=$result->fields[6];

	}
	$result->Close();
}



if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="experiencia.detalle.php"){
	$sql="select dsm,dsdp,dskw,dsruta,dsimg1,dsd,id from tblexperiencia where (dsruta='$dsnombre' ";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."productos.detalle.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	   	$idrelacion=$result->fields[6];
	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="galeria.detalle.php"){
	$sql="select dsm,dsd2,dskw,dsruta,dsimg from tblpaginagaleria where (dsruta='$dsnombre' ";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."productos.detalle.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	   	$idrelacion=$result->fields[6];
	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="eventos.detalle.php"){
	$sql="select dsm,dsd2,dskw,dsruta from tbleventos where (dsruta='$dsnombre' ";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."productos.detalle.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	   	$idrelacion=$result->fields[6];
	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="fundacion.detalle.php"){
	$sql="select dsm,dsd,dsruta from tblfundacion where (dsruta='$dsnombre' ";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."productos.detalle.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		//if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	   	$idrelacion=$result->fields[6];
	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="convenios.detalle.php"){
	$sql="select dsm,dsd,dsruta from tblconvenios where (dsruta='$dsnombre' ";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."productos.detalle.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		//if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	   	$idrelacion=$result->fields[6];
	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"" || $_REQUEST['id']<>"") &&  $pag=="blog.php"){
	$sql="select dsm,dsd2,dsruta,dsimg,id,dsimg2 from  blogtblblog where (dsruta='$dsnombre' ";
	if ($idrelacion<>"") $sql.=" or id=".$idrelacion;
	if ($_REQUEST['id']<>"") $sql.=" or id=".$_REQUEST['id'];

	$sql.=") and idactivo not in (2,9) ";

	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."blog.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		//if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$imgsindicacion=trim($result->fields[3]);
		if($imgsindicacion=="")$imgsindicacion=trim($result->fields[5]);
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[2]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/blog/'.$imgsindicacion;
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[1])),300);
		$title_sindicacion=$dstitulox;
	   	$idrelacion=$result->fields[4];
	}
	$result->Close();
}

if(($dsnombre<>"" || $idrelacion<>"") &&  $pag=="asociados.detalle.php"){
	$sql="select dsm,dsd,dsruta from tblasociados where (dsruta='$dsnombre' ";
	if ($idrelacion<>"") $sql.=" or id=$idrelacion ";
	$sql.=") and idactivo not in (2,9) ";
//echo $sql;
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."productos.detalle.php";
		$title_miga=$dstitulox;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		//if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	   	$idrelacion=$result->fields[6];
	}
	$result->Close();
}



	$sql="select dstitulo,dsdesc,dskeyw,title,robots,abstract,author,copyright,rating,replyto,creationdate,docrights from tblempresa ";
 	//$sql.="  ";
 	//$sql.=" where id=$idtienda";
 	//echo $sql;
	$resultx=$db->Execute($sql);
			if (!$resultx->EOF) {
				if ($dstitulox=="") $dstitulox=reemplazar($resultx->fields[0]);
				if ($dsdescr=="") $dsdescr=$resultx->fields[1];
				if ($dsclaves=="") $dsclaves=$resultx->fields[2];
					$title=reemplazar($resultx->fields[3]);
				if($dstitulox==""){
			    	$title=reemplazar($resultx->fields[0]);
			    }
				$robots=$result->fields[4];
				$abstract=$result->fields[5];
				$author=$result->fields[6];
				$copyright=$result->fields[7];
				$rating=$result->fields[8];
				$reply=$result->fields[9];
				$creation=$result->fields[10];
				$doc=$result->fields[11];

			}
			$resultx->Close();
				if(($dsnombre<>"" || $idrelacion<>"")  &&  $pag=="ecommerce.productos.php"){
	$sql="select dsm,dsdp,dskw,dsruta,dsimg1,dsd,id from ecommerce_tblsubcategoriasxcategoria where ";
	if($dsnombre<>"") $sql.=" dsruta='$dsnombre' and idactivo not in (2,9) ";
	if($idrelacion<>"")$sql.=" id='$idrelacion' and idactivo not in (2,9) ";
	$result = $db->Execute($sql);
	if (!$result->EOF) {
		$dstitulox=reemplazar(trim($result->fields[0]));
		$ruta_miga=$rut."novedades.php";
		$title_miga=$title2;
		if ($dsdescr=="")$dsdescr=trim($result->fields[1]);
		$dsdescr=reemplazar($dsdescr);
		if ($dsclaves=="")$dsclaves=trim($result->fields[2]);
		// Datos para la Sindicacion
		$rutax_sindicacion = 'http://'.$autorizado.'/contenidos/';
		$ruta_sindicacion =$rutax_sindicacion.trim($result->fields[3]);
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
	 	$idrelacion=$result->fields[6];
	 	
	 	if($idrelacion<>"" && $_REQUEST['dscategoriax']==""){
	 	$dsmigax=seldato('dsm','id','ecommerce_tblcategoria',$_REQUEST['dscategoria'],1);
	 	}elseif($_REQUEST['dscategoriax']<>""){
	 	$dsmigax=seldato('dsm','dsruta','ecommerce_tblcategoria',$_REQUEST['dscategoriax'],2);
	 	}
	 	$dsmigax=reemplazar($dsmigax);
	 	$dsmiga=$dsmigax." | ".$dstitulox;

	}
	$result->Close();
}

?>