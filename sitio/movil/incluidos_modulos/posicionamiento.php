<?
//posicionamiento ofertas de formacion
//echo $idc;
//echo $pag;


	if($rutap<>1) $pag=$pagina;
	$rutaPaginas=$rut."../contenidos/images/paginas/";

	$sql="select dstit,dsd,dskw,dsd2,id,idactivo,dstitulo,dstabla,rutadetalle,dsimg1,idvista,dsvideo from tblpaginas where (dsm='$pag' or dsmalterna='$pag') and idactivo not in(2,9)  ";
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
		$idvista=$result->fields[10];
		$dsvideo1=$result->fields[11];


	} else {


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
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
		$text_sindicacion = elliStr(reemplazar(trim($result->fields[5])),300);
		$title_sindicacion=$title2;
		$idrelacion=$result->fields[6];

	}
	$result->Close();
}



// Fin posicionamiento Noticias

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
		$rutaimagen_sindicacion = $rutax_sindicacion.'images/noticias/'.trim($result->fields[4]);
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

?>