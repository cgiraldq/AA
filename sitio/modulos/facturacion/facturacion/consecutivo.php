	<?	
	$sql=" select idconsecactual,dsprefijo,dsres from tblresoluciones where dsres='$dsres' and dsprefijo='$dsprefijo' and idconsecini='$idinicial' and idconsecfin='$idfinal'  ";
	//echo $sql;
	$vermasc=$db->Execute($sql);
	if(!$vermasc->EOF){////

	$idconsec=$vermasc->fields[0];
	$dsres=$vermasc->fields[2];
	$dsprefijo=$vermasc->fields[1];
    $idpedido=$idconsec+1;
	}$vermasc->Close();

	//$idconsecutivo=$idpedido;
	//echo $idpedido;
	//exit();
	?>