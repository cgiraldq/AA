<?
//echo "$dsrx";
 if ($dsrx=="")  {
 		$dsrx="#";$dsdx="Temporalmente Deshabilitado";
 }
?>
<? if($dsmx<>"Ver APPS"){?><a href="<? echo $rutxx.$dsrx?>" title="<? echo $dsdx?>" class="link"><? echo $dsmx?></a>
<?}else{?>
<a target="_blank" href="<? echo $dsrx?>" title="<? echo $dsdx?>" class="link"><? echo $dsmx?></a>
<?}?>