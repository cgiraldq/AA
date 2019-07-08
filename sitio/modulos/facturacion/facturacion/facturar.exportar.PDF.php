<?php
include ("../sessiones.php");
include ("../../incluidos/vargenerales.php");
include ("../../incluidos/varconexion.php");
include ("../../incluidos/abrirconexion.php");
include ("../../incluidos/funciones.php");

$idcliente=$_REQUEST['idcliente'];
$idpedido=$_REQUEST['idpedido'];
$no=$_REQUEST['no']; // no actualizar

$fecha="<b>".$_REQUEST['fecha']."</b>";
$cuenta_cobro="<b>Cuenta de cobro. ".$idpedido."</b>";
$nombrecliente=$_REQUEST['nombrecliente']; 
$nombrecliente=ereg_replace(" ","",$nombrecliente);
$cliente=$_REQUEST['cliente'];
//$cliente=ereg_replace("%","\n",$cliente);
$debe="<b>".$_REQUEST['debe']."</b>";
$identificado=$_REQUEST['identificado'];
$contacto=$_REQUEST['contacto'];
$concepto=$_REQUEST['concepto'];
//$concepto=ereg_replace("<br>","\n",$concepto);
$total="<b>$ ".$_REQUEST['total']."</b>";
$anticipo=$_REQUEST['anticipo'];
$letras="<b>".$_REQUEST['letras']."</b>";
$observaciones=$_REQUEST['observaciones'];
//$observaciones=ereg_replace("<br>","\n",$observaciones);
$pago1=$_REQUEST['pago1'];
$pago2=$_REQUEST['pago2'];
//$pago2=ereg_replace("<br>","\n",$pago2);
$pago=$pago1."\n".$pago2;


include ('../../pdf_class/class.ezpdf.php');
$pdf =& new Cezpdf('LETTER');
$pdf->selectFont('../../pdf_class/fonts/Helvetica.afm');


// ENCABEZADO

		$sql="select a.* from tblusuariose a, tblfacturase b";
		$sql.=" where b.idusuario=a.id and b.idpedido=$idpedido ";
		//echo $sql;
		$vermasx=mysql_db_query($dbase,$sql,$db);
		if (mysql_num_rows($vermasx)==1) { 
		$dsnombreu=mysql_result($vermasx,"0","dsnombre");
		$dscorreo=mysql_result($vermasx,"0","dscorreo");
		$dstel=mysql_result($vermasx,"0","dstel");
		$dsdirc=mysql_result($vermasx,"0","dsdirc");
		$dsciudad=seldato("dsciudad","idciudad","tblciudades",mysql_result($vermasx,"0","idciudad"),1);

		$dsnitu=mysql_result($vermasx,"0","dscedula");
		$dsnitdonde=mysql_result($vermasx,"0","dsdondec");


/*
echo "<span class=textnegrotitf><strong>".$dsnombreu."</strong></span>";
echo "<hr width='80%' noshade='noshade' size='2'>";
echo "".mysql_result($vermasx,"0","dscorreo")."";
echo "<br>".mysql_result($vermasx,"0","dstel")."";
echo "&nbsp;".mysql_result($vermasx,"0","dsdirc")."<br>";
echo "".seldato("dsciudad","idciudad","tblciudades",mysql_result($vermasx,"0","idciudad"),1)."<br>";
*/
		}
			mysql_free_result($vermasx);
			
		//y=ezText(text,[size],[array options])
		
		$pdf->ezText("<b>".$dsnombreu."</b>",20);
		$pdf->ezText('_____________________________________________________________________________________________________________________',5);
		$pdf->ezText($dscorreo,10);
		$pdf->ezText($dstel,10);
		$pdf->ezText($dsdirc,10);
		$pdf->ezText($dsciudad,10);
		$pdf->ezText(' ',10);
		$pdf->ezText(' ',10);				
		
		
	//	$pdf->stream();
			

// FIN ENCABEZADO			

if ($anticipo<>"" && $observaciones<>"" && $pago1<>"") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'ANTICIPO','dato'=>'$ '.$anticipo)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	,array('titulo'=>'OBSERVACIONES','dato'=>$observaciones)
	,array('titulo'=>'FECHA DE PAGO','dato'=>$pago)
	);

}elseif ($anticipo=="" && $observaciones<>"" && $pago1<>"") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	,array('titulo'=>'OBSERVACIONES','dato'=>$observaciones)
	,array('titulo'=>'FECHA DE PAGO','dato'=>$pago)
	);

}elseif ($anticipo=="" && $observaciones=="" && $pago1<>"") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	,array('titulo'=>'FECHA DE PAGO','dato'=>$pago)
	);

}elseif ($anticipo=="" && $observaciones=="" && $pago1=="") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	);

}elseif ($anticipo=="" && $observaciones<>"" && $pago1=="") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	,array('titulo'=>'OBSERVACIONES','dato'=>$observaciones)
	);

}elseif ($anticipo<>"" && $observaciones=="" && $pago1=="") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'ANTICIPO','dato'=>'$ '.$anticipo)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	);

}elseif ($anticipo<>"" && $observaciones=="" && $pago1<>"") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'ANTICIPO','dato'=>'$ '.$anticipo)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	,array('titulo'=>'FECHA DE PAGO','dato'=>$pago)
	);

}elseif ($anticipo<>"" && $observaciones<>"" && $pago1=="") { 

	$data = array(
	 array('titulo'=>'FECHA','dato'=>$fecha)
	,array('titulo'=>'ASUNTO','dato'=>$cuenta_cobro)
	,array('titulo'=>'EL CLIENTE','dato'=>$cliente)
	,array('titulo'=>'DEBE A','dato'=>$debe)
	,array('titulo'=>'IDENTIFICADO CON','dato'=>$identificado)
	,array('titulo'=>'CONTACTO','dato'=>$contacto)
	,array('titulo'=>'POR CONCEPTO DE','dato'=>$concepto)
	,array('titulo'=>'PARA UN TOTAL DE','dato'=>$total)
	,array('titulo'=>'ANTICIPO','dato'=>'$ '.$anticipo)
	,array('titulo'=>'EN LETRAS','dato'=>$letras)
	,array('titulo'=>'OBSERVACIONES','dato'=>$observaciones)
	);

}



		$cols = array('titulo'=>'','dato'=>'');
		$pdf->ezTable(	$data,
						$cols,
						'',
						array('showHeadings'=>0,'showLines'=>2,'shaded'=>0,'xOrientation'=>'center','width'=>400,
							'cols' =>array('titulo'=>array('width'=>150))
						)
					  );
			  
		$y=$pdf->ezText(' ',100);
		//$pdf->ezImage('firma.jpg',0,80,'none');


		$strSQL=" select idusuario from tblfacturase where idpedido='$idpedido' ";
		//echo $strSQL;
		$vermasy=mysql_db_query($dbase,$strSQL,$db);
		if (mysql_num_rows($vermasy)>0){
			$idusuario=mysql_result($vermasy,"0","idusuario");
		}

		$firma="../../temas/imagenes/".$idusuario.".jpg";  
		//if (is_file($firma)){
			$pdf->addJpegFromFile($firma,40,$y,100);		
		//}
		$pdf->ezText('___________________________________________________',5);
		$pdf->ezText("<b>".$dsnombreu."</b>",10);
		$pdf->ezText("<b>".$dsnitu." de ".$dsnitdonde."</b>",10);

	
  $name="../../temas/facturas/factura_".$idpedido."_".$nombrecliente.".pdf";

  $pdfcode = $pdf->ezOutput();
  $fp=fopen($name,'wb');
  fwrite($fp,$pdfcode);
  fclose($fp);

  //$pdf->ezStream();

?>

<html>
<title>VALIDANDO....</title>
<head>

			<meta http-equiv="REFRESH" content="0; URL=facturar.cuarto.paso.php?idcliente=<? echo $idcliente; ?>&idpedido=<? echo $idpedido; ?>&no=<? echo $no; ?>">  

</head>
<body>
<div align="center">

<br>
	<div align="center">

	<table width="95" align="center" >
	  <tr>
	    <td width="87" height="85"><div align="center"><img src="../../temas/imagenes/logocf.gif" /></td>
	  </tr>
	</table>
	<font face=Arial size=-1>
	 Un momento mientras se genera el archivo PDF...
	</font>
	</div>
</body>
</html>
