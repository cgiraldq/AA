
<?
	$sql="select id,dsm,idcantdblog from blogtbltema where idblog=$idrelacion";
		//echo $sql;
		//exit;
		$resultb= $db->Execute($sql);
			if ($resultb->EOF) {
	$sql="insert into tbltema_ml ( ";
	$sql.="idblog,dsfecha,idcantdblog";
	$sql.=") values (";
	$sql.="$idrelacion,'$fechaBase',1)";
	//echo $sql;
	//exit;
	$db->Execute($sql);//exit();
}else{

$cantidad=$resultb->fields[2];


  $i = 0;
  while($i <= $cantidad)  $i += 1;
  //echo 'La variable $i vale: ' . $i ;


	$sql=" update blogtbltema set ";
					$sql.="idblog=$idrelacion";
					$sql.=", idcantdblog='$i'";
					$sql.=", dsfecha='$fechaBase'";
					$sql.=" where idblog=".$idrelacion;
					//echo $sql;
					//exit;
					if ($db->Execute($sql))  {

					}

}
//exit();


























?>