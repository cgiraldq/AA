<?
/////////////////////////////////////////// agragar campo tipo texto /////////////////////////////////////////////
			if($idtipo==1 || $idtipo==3 || $idtipo==5 || $idtipo==16 || $idtipo==17 ){
				$sqlx="ALTER TABLE $nombretabla ADD ".$dsmx." VARCHAR(255) NULL DEFAULT NULL;";
			}

////////////////////////////////////////// agragar campo tipo texto grande //////////////////////////////////////////
			if($idtipo==2 || $idtipo==13){
				$sqlx="ALTER TABLE $nombretabla ADD ".$dsmx." MEDIUMTEXT NULL DEFAULT NULL;";
			}

////////////////////////////////////////// agragar selecionador //////////////////////////////////////////
			if($idtipo==4 || $idtipo==6 || $idtipo==7 || $idtipo==8 || $idtipo==11 || $idtipo==12 || $idtipo==14 || $idtipo==15){
				$sqlx="ALTER TABLE $nombretabla ADD ".$dsmx." BIGINT(18) NULL DEFAULT NULL;";
			}			
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>