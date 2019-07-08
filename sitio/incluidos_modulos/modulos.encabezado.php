
<?
	if($_SESSION['i_idperfil']==4)$rut="../../salir.php";
	else $rut="../validaciones/salir.php";
?>

<?
    $rutaImagend=$rutxx."../../../contenidos/images/logo_empresa/";
    $rutaImagend2="../../../contenidos/images/logo_empresa/";
    
    $sqld="select id,dsnombre,dsimg1,copyright,dstitulo,codcliente from tblempresa where id=1";
    $resultd=$db->Execute($sqld);
    if(!$resultd->EOF){
    $id=$resultd->fields[0];
    $dsmempresa=reemplazar($resultd->fields[1]);
    $dsimg1empresa=$resultd->fields[2];
    $derechos=reemplazar($resultd->fields[3]);
    $dstituloempresa=reemplazar($resultd->fields[4]);
    $codcliente=reemplazar($resultd->fields[5]);


?>
<header>
   	<article class="logo">

            <? 
            if(is_file($rutaImagend.$dsimg1empresa)){ ?>

            <img src="<? echo $rutaImagend.$dsimg1empresa ?>" >
             <? }elseif (is_file($rutaImagend2.$dsimg1empresa)){ ?>
			<img src="<? echo $rutaImagend2.$dsimg1empresa ?>" >
            
             <? } else {?>
            <br>
            <? echo $dstituloempresa?>
            <br>
            <? echo $derechos ?>
            <? } ?>
            
            <?
            }
            $resultd->Close();
            ?>
	</article>

	<? if ($_SESSION['i_idperfil']<>-1) {?>
	<article class="cont_izq">
		<?//include("incluidos_sitio/header/opciones.php");?>
		<ul class="link_header">
			<li><a href="<?echo $rutxx?>../buscador/modulos/default.php" title="" target="_top"><p>Modulos disponibles</p></a></li>
			<li><a href="<?echo $rutxx?>../core/default.php" title="Click para regresar al principal del sistema" target="_top"><p>Principal del sistema</p></a></li>
			<li><a href="<?echo $rutxx?>../gestorrecursos/estatus/default.php" ><p class="textverdelink">Estatus del sistema</p></a></li>
			<!--li><a href="<?echo $rutxx?>../gestorrecuros/estatus/default.php#paginas" ><p class="textrojolink">Advertencia</p></a></li>
			<li><a href="<?echo $rutxx?>../gestorrecuros/estatus/default.php#empresa" ><p class="textnaranjalink">Pendientes</p></a></li-->
			<li><a href="javascript:cargarRutaCoreCF('core.manual','<? echo $_SESSION['rutacore']?>');"><p class="textverdelink">Manual del sistema</p></a></li>
			<li><a href="javascript:cargarRutaCoreCF('core.tickets','<? echo $_SESSION['rutacore']?>');"><p class="textverdelink">Sistema Tickets</p></a></li>

		</ul>
	</article>
	<? } ?>
<? if ($_SESSION['i_idperfil']==-1) {?>
	<article class="cont_izq">
		<?//include("incluidos_sitio/header/opciones.php");?>
		<ul class="link_header">
			<li><a href="<?echo $rutxx?>../root/default.php" title="Click para regresar al principal del sistema" target="_top"><p>Principal del sistema</p></a></li>


		</ul>
	</article>
	<? } ?>



	<article class="cont_derecha">

	<nav class="inicio_sesion">
	  <ul>
		  <li>
		    <a href="#" class="button add">
		    	<img src="<? echo $rutxx;?>../../images/user.jpg">
		    </a>
		  </li>

		   <div class="dialog" style="display:none">
		      <form action="#" method="post">
		      	<article class="img_login">
		      		<img src="<? echo $rutxx;?>../../images/user2.jpg">
		      	</article>

		      	<article class="txt_login">

		      		<h1><? echo $_SESSION['i_dsnombre']?>, <? echo $_SESSION['i_dsempresa']?></h1>
		      		<h2>IP<? echo $remoto?></h2>
<? if ($_SESSION['i_idperfil']==1) {?>
		      		<a href="<? echo $rutxx;?>../root/empresa/empresa.php"><p>Configuraciones</p></a>
<?   } ?>
		      		<a href="<? echo $rutxx;?>../validaciones/salir.php?ir=<? echo $rutxx;?>" title="Click para salir del modulo administrador" target="_top" class="cerrar_sesion">
		      			Cerrar sesi&oacute;n
		      		</a>

		      	</article>
		    </form>
		  </div>
	  </ul>

	</nav>

	</article>

<? //include($rutxx."../../incluidos_modulos/modulos.servicios.php");?>
<? if ($apagar=="") include("../../incluidos_modulos/modulos.menus.php");?>
<? include($rutxx."../../incluidos_modulos/modulos.capa.cargando.php");?>

</header>