
<?
	if($_SESSION['i_idperfil']==4)$rut="../../salir.php";
	else $rut="../validaciones/salir.php";
?>

<?
    $rutaImagend="../../../contenidos/images/empresa/";
    $sqld="select id,dsnombre,dsimg1,copyright,dstitulo,codcliente from tblempresa where id=1";
    $resultd=$db->Execute($sqld);
    if(!$resultd->EOF){
    $id=$resultd->fields[0];
    $dsmepresa=reemplazar($resultd->fields[1]);
    $dsimg1empresa=$resultd->fields[2];
    $derechos=reemplazar($resultd->fields[3]);
    $dstituloempresa=reemplazar($resultd->fields[4]);
    $codcliente=reemplazar($resultd->fields[5]);


?>
<header>
   	<article class="logo">

            <? if(is_file($rutaImagend.$dsimg1empresa)){ ?>

            <img src="<? echo $rutaImagend.$dsimg1empresa ?>" ><? } ?>

            <br>
            <? echo $dstituloempresa?>
            <br>
            <? echo $derechos ?>
            <?
            }
            $resultd->Close();
            ?>
	</article>

	<article class="cont_izq">
		<?//include("incluidos_sitio/header/opciones.php");?>
		<ul class="link_header">
			<li><a href="../core/default.php" title="Click para regresar al principal del sistema" target="_top"><p>Principal del sistema</p></a></li>
			<li><a href="../estatus/default.php" ><p class="textverdelink">Estatus del sistema</p></a></li>
			<li><a href="../estatus/default.php#paginas" ><p class="textrojolink">Advertencia</p></a></li>
			<li><a href="../estatus/default.php#empresa" ><p class="textnaranjalink">Pendientes</p></a></li>
			<li><a href="../utilidades/manual.php" ><p class="textverdelink">Manual del sistema</p></a></li>
			<li><a href="http://www.comprandofacil.com/servicioalcliente/validar.php?codcliente=<? echo $codcliente?>" target="_blank"><p class="textverdelink">Sistema Tickets</p></a></li>

		</ul>
	</article>

	<article class="cont_derecha">

	<nav class="inicio_sesion">
	  <ul>
		  <li>
		    <a href="#" class="button add">
		    	<img src="../../images/user.jpg">
		    </a>
		  </li>

		   <div class="dialog" style="display:none">
		      <form action="#" method="post">
		      	<article class="img_login">
		      		<img src="../../images/user2.jpg">
		      	</article>

		      	<article class="txt_login">

		      		<h1><? echo $_SESSION['i_dsnombre']?>, <? echo $_SESSION['i_dsempresa']?></h1>
		      		<h2>IP<? echo $remoto?></h2>
<? if ($_SESSION['i_idperfil']==1) {?>
		      		<a href="../root/empresa.php"><p>Configuraciones</p></a>
<?   } ?>
		      		<a href="../validaciones/salir.php" title="Click para salir del modulo administrador" target="_top" class="cerrar_sesion">
		      			Cerrar sesi&oacute;n
		      		</a>

		      	</article>
		    </form>
		  </div>
	  </ul>

	</nav>

	</article>

<? //include("../../incluidos_modulos/modulos.servicios.php");?>
<? if ($apagar=="") include("../../incluidos_modulos/modulos.menus.php");?>
<? include("../../incluidos_modulos/modulos.capa.cargando.php");?>

</header>