/*
| ----------------------------------------------------------------- |
*/
// funciones genericas de javascript
//cargadores globales
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function ActivarTodo(forma,campobase)
  {
  var sa=false;
  var x=eval("document."+forma);
  var y=eval("document."+forma+"."+campobase);
  if(y.checked)
    sa=true;

  for (var i=0;i<x.elements.length;i++)
    {
    var e = x.elements[i];
	if (x.elements[i].name!="borrar1") {
		if(sa)
		  e.checked=true;
		else
		  e.checked=false;
		}
	}
 }

 function ActivarTodoGeneral(forma,campobase,camposeleccionado)
  {
  var sa=false;
  var x=eval("document."+forma);
  var y=eval("document."+forma+"."+campobase);
  if(y.checked)
    sa=true;

  for (var i=0;i<x.elements.length;i++)
    {
    var e = x.elements[i];
	if (x.elements[i].name==camposeleccionado) {
		if(sa)
		  e.checked=true;
		else
		  e.checked=false;
		}
	}
 }


function irAPaginaD(ruta){
	var redir = ruta;
	if (redir!=""){
		location.href=redir;
	}
}


function redondear(num)
{
//            var original=new String(num);
//            partir=original.split(".");
//            dec=partir[1];
/*
                if (partir>=5) {
                               result=Math.ceil(original)
                } else {
                               result=Math.ceil(original)
                }
*/
                result=num.toFixed(0);

                // result=num;

                return result;
}


// funcion de abrir ventana
function irAPaginaDN(ruta,ancho,alto){
	var redir=ruta;
	if (redir!=""){
		window.open(redir,"",'scrollbars=YES,width=600,height=600,left=30,top=2,resizable=yes');
	}
}

function imprimir_pedido(ruta,ancho,alto){
	var redir=ruta;
	if (redir!=""){
		window.open(redir,"",'scrollbars=YES,width='+ancho+',height='+alto+',left=30,top=2,resizable=yes');
	}
}

// cambia de color cuando se para por encima de la celda
function mOvr(src,clrOver) {
 if (!src.contains(event.fromElement)) {
	 src.style.cursor = 'default';
	 src.bgColor = clrOver;
	}
 }
function mOut(src,clrIn) {
	if (!src.contains(event.toElement)) {
	 src.style.cursor = 'default';
	 src.bgColor = clrIn;
	}
 }

// cambiar de una pagina a otra con recarga
function CargarPagina(newLocation)
	{
		var ventana;
		ventana = window.parent.opener;
		ventana.location = newLocation;
		window.parent.close();
	}


function CargarPagina1(newLocation,tipo)
	{
		var ventana;
		ventana = window.parent.opener;
		ventana.location = newLocation;
	}

function enviarconfirmx(m1,forma,redir){

		if (confirm(m1)== true ){
			if (forma!=""){
			var formabase=eval("document."+forma);
			formabase.submit();
			} else{
			location.href=redir;
			}
		}
}
function enviarconfirm(m1,m2,forma,redir){

		if (confirm(m1)== true ){
			if (forma!=""){
			var formabase=eval("document."+forma);
			formabase.submit();
			} else{
			location.href=redir;
			}
		} else {
			alert(m2);
			return;
		}
}
function enviarconfirma(m1,redir){

		if (confirm(m1)== true ){
			location.href=redir;
		}
}

function mensajeshtml(id,mensaje){
		var idbase=eval("document.getElementById('"+id+"')");
		var dsbase=eval("document.all."+id);
		dsbase.style.display="";
		idbase.innerHTML=mensaje;
}

function mostrar(numero) {
	var capabase=document.getElementById('capaseleccion_'+numero);
	if (capabase) {
		capabase.style.display="";
	}

}


function quitar(numero) {
	var capabase=document.getElementById('capaseleccion_'+numero);
	if (capabase) {
		capabase.style.display="none";
	}

}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function ocultar(capa) {
	var base=document.getElementById(capa);
	if (base) base.style.display="none";
}

function valU(forma,param){
	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var i;
    var bError = false;
	var valor="";
    for (i = 0; i < n; i++){
     bError = bError || (eval(base + partir[i] + ".value == ''"));
	 if (bError){
		 document.getElementById('capa_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }
    }
	if (valor=="") eval(base+"submit()");
}

function valUS(forma,param,valor){

	var base="document."+forma+".";
	partir=param.split(",");
	nombres=valor.split(",");
	n=partir.length;
	var i;
    var bError = false;
	var valor="";
    for (i = 0; i < n; i++){
     bError = bError || (eval(base + partir[i] + ".value == ''"));
	 if (bError){
		 alert("Debe ingresar "+nombres[i]);
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else if(partir[i]=='dsemail'){
     	var re  = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
		if (!re.test(eval(base + partir[i] + ".value"))) {
			alert ("El correo electronico no es correcto");
			eval(base + partir[i] + ".focus()");
			valor=1;
		 	break;
		}
     }
     else {
	 	valor="";
	 }
    }
    //alert(valor);
	if (valor==""){ eval(base+"submit()");}
}

function valUC(forma,param,m1){
	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var i;
    var bError = false;
	var valor="";
    for (i = 0; i < n; i++){


     bError = bError || (eval(base + partir[i] + ".value == ''"));
	 if (bError){
		 document.getElementById('capa_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }
    }
	if (valor==""){
	if (confirm(m1)== true ){
			eval(base+"submit()");
		}
	 }
}


function valUp(forma,param){
//alert ('hola');
	var re  = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var tam=n-1;
	var i;
    var bError = false;
	var valor="";
	var x;
    for (i = 0; i < n; i++){
    x=eval(base + partir[i] + ".value");
    x=x.replace(/^\s+/,"");
     bError = bError || (x == "");
	 if (bError){
	 	eval(base + partir[i] + ".value=''");
		 document.getElementById('capax_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }



}

var correobase1=document.getElementById('dscorreo');
var clave1=document.getElementById('dsclave');
var clave2=document.getElementById('dsclave2');

if (correobase1){
    if (correobase1.value!=""){
	    if (!re.test(correobase1.value)) {
	       document.getElementById('capax_dscorreo').innerHTML="El correo no es valido";
	       document.getElementById('capax_dscorreo').style.display='';
	       correobase1.focus();
	       valor=1;
	   	}
    }
  }

if(clave1){
if (clave1.value!=clave2.value) {
   document.getElementById('capax_dsclave').innerHTML="Ambos correos deben ser iguales";
   document.getElementById('capax_dsclave2').style.display='';
   clave2.focus();
   valor=1;
}
}
var dsacepto=document.getElementById('dsacepto');
if(dsacepto){
	if (dsacepto.checked==false) {
	   document.getElementById('capax_dsacepto').style.display='';
	   valor=1;
	}
}


    if(partir[tam]=="captcha"){
    var texto=eval(base + partir[tam] + ".value");
		if (texto!="") {
			// cargar cliente y colocar las variables seleccionadas
			//alert(texto);
			conexion=AjaxObj();
			 conexion.open("POST","captcha/captcha.validar.php?captcha="+texto,true);
		     conexion.onreadystatechange =function() {
					 if (conexion.readyState==4) {
					 var _resultado = conexion.responseText;
					 //alert(_resultado);
						if (_resultado==1) {
							if(valor=="")eval(base+"submit()");
						}else{
							document.getElementById('capax_cap').style.display="";
							document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
							eval(base + partir[tam] + ".value=''");
							eval(base + partir[tam] + ".focus()");
							return;
						}
					} // fin funcion
			      } // fin conexion
			    //contenedor.innerHTML ="";
		conexion.send(null) // limpia conexion
	}
	}else{
		if(valor=="")eval(base+"submit()");
	}
	//if (valor=="")
}

function valUp2(forma,param){
	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var tam=n-1;
	var i;
    var bError = false;
	var valor="";
	var x;
    for (i = 0; i < n; i++){
    x=eval(base + partir[i] + ".value");
    x=x.replace(/^\s+/,"");
     bError = bError || (x == "");
	 if (bError){
	 	eval(base + partir[i] + ".value=''");
		 document.getElementById('capax_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }
    }
    if(partir[tam]=="captcha"){
    var texto=eval(base + partir[tam] + ".value");
		if (texto!="") {
			// cargar cliente y colocar las variables seleccionadas
			//alert(texto);
			conexion=AjaxObj();
			 conexion.open("POST","../../captcha/captcha.validar.php?captcha="+texto,true);
		     conexion.onreadystatechange =function() {
					 if (conexion.readyState==4) {
					 var _resultado = conexion.responseText;
					 //alert(_resultado);
						if (_resultado==1) {
							if(valor=="")eval(base+"submit()");
						}else{
							document.getElementById('capax_cap').style.display="";
							document.getElementById('captcha').src='../../captcha/captcha.php?'+Math.random();
							eval(base + partir[tam] + ".value=''");
							eval(base + partir[tam] + ".focus()");
							return;
						}
					} // fin funcion
			      } // fin conexion
			    //contenedor.innerHTML ="";
		conexion.send(null) // limpia conexion
	}
	}else{
		if(valor=="")eval(base+"submit()");
	}
	//if (valor=="")
}



function setCounter(size,campo,contador,campobase,forma)
        {
   var formaval=eval("document."+forma+"."+campobase);
	   var formacount=eval("document."+forma+"."+contador);
	    MessageSize = formaval.value.length;
		 if (MessageSize > size)
		 {
			if(campo==1)
			{
			 formaval.value = formaval.value.substring(0,size);
			}
			else
			{
			 size = size - formaval.value.length;
			}
			CRestantes = 0;
		 }
		 else
		 {
			CRestantes = size - MessageSize;
		 }
		 formacount.value = CRestantes;
}


function val(forma){
		var formabase=eval("document."+forma);



		var re  = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
		if (!re.test(formabase.dscorreocliente.value)) {
			alert ("El correo electronico no es correcto");
			formabase.dscorreocliente.focus();
		return false;
		}

		if (formabase.dsclave.value==""){
			alert("Por favor ingrese la clave");
			formabase.dsclave.focus();
			return false;
		}

		if (formabase.dsnit.value==""){
			alert("Por favor ingrese la identificacion");
			formabase.dsnit.focus();
			return false;
		}



		if (formabase.dsnombre.value==""){
			alert("Por favor ingrese el nombre");
			formabase.dsnombre.focus();
			return false;
		}


		if (formabase.dsapellido.value==""){
			alert("Por favor ingrese el apellido");
			formabase.dsapellido.focus();
			return false;
		}
/*

		if (formabase.acepto.checked==false){
			alert("Por favor acepte los terminos y condiciones");
			return false;
		}
*/


		return true;
}
function verificar(forma){
	var formabase=eval("document."+forma);

	var re  = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	if (!re.test(formabase.dscorreocliente.value)) {
		alert ("El correo electronico no es correcto");
		formabase.dscorreocliente.focus();
		return;
	} else {
		conexion=AjaxObj();
		document.all.capa_validar.style.display = "";
		conexion.open("POST","modulos/validaciones/verificar.php?param="+formabase.dscorreocliente.value,true);
		conexion.onreadystatechange =function() {
		//			alert(conexion.readyState);
			 if (conexion.readyState==4) {
			 var _resultado = conexion.responseText;
			 if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
			contenedor=document.getElementById('capa_validar');
			contenedor.innerHTML = _resultado;
			 } else {
		  }  // fin resultado
		} // fin conexion
	  } // fin funcion conexion interna
	  conexion.send(null) // limpia conexion
	}
}

function valAfiliado(forma,param,total){

	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var i;
    var bError = false;
	var valor="";
    for (i = 0; i < n; i++){
     bError = bError || (eval(base + partir[i] + ".value == ''"));
	 if (bError){
		 document.getElementById('capa_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }
    }
    // validacion campos tipo vector


    for (var i=0;i<total;i++) {

    	if (document.getElementById('dsmb'+i).value!="") {

    		if (document.getElementById('dsapelb'+i).value!="") {

    			if (document.getElementById('dstipodocb'+i).value!="") {

	    			if (document.getElementById('dsnumdocb'+i).value!="") {

		    			if (document.getElementById('dsparentescob'+i).value=="") {

			    			 try
							{
			    			 document.getElementById('capa_dsparentescob'+i).style.display="";
							 document.getElementById('dsparentescob'+i).focus();
							 valor=1;
							 break;
							 }
							catch(err)
					  		{
					  		}
		    			}
	    			}
	    			else
	    			{
	    				try
						{
		    			 document.getElementById('capa_dsnumdocb'+i).style.display="";
						 document.getElementById('dsnumdocb'+i).focus();
						 valor=1;
						 break;
						 }
						catch(err)
			  			{
			  			}
	    			}
    			}
    			else
    			{
    				try
					{
	    			document.getElementById('capa_dstipodocb'+i).style.display="";
					document.getElementById('dstipodocb'+i).focus();
					 valor=1;
					 break;
					 }
					catch(err)
		  			{
		  			}
    			}
    		}
    		else
    		{
    			try
				{
	    		 document.getElementById('capa_dsapelb'+i).style.display="";
				 document.getElementById('dsapelb'+i).focus();
				 valor=1;
				 break;
				}
				catch(err)
	  			{
	  			}
	    	}
    	}
    	else
    	{
    		try
			{
    		 document.getElementById('capa_dsmb'+i).style.display="";
			 document.getElementById('dsmb'+i).focus();
			 valor=1;
			 break;
			}
			catch(err)
  			{
  			}
    	}
    }


	if (valor=="") eval(base+"submit()");
}

function valreferente(forma,param,total){

	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var i;
    var bError = false;
	var valor="";
    for (i = 0; i < n; i++){
     bError = bError || (eval(base + partir[i] + ".value == ''"));
	 if (bError){
		 document.getElementById('capa_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }
    }
    // validacion campos tipo vector

    for (var i=0;i<total;i++) {

    	if (document.getElementById('dsmb'+i).value!="") {

    		if (document.getElementById('dsapelb'+i).value!="") {

    			if (document.getElementById('dstelefono'+i).value!="") {

		    			if (document.getElementById('dsemail'+i).value=="") {

			    			 try
							{
			    			 document.getElementById('capa_dsemail'+i).style.display="";
							 document.getElementById('dsemail'+i).focus();
							 valor=1;
							 break;
							 }
							catch(err)
					  		{
					  		}
		    			}
    			}
    			else
    			{
    				try
					{
	    			document.getElementById('capa_dstelefono'+i).style.display="";
					document.getElementById('dstelefono'+i).focus();
					 valor=1;
					 break;
					 }
					catch(err)
		  			{
		  			}
    			}
    		}
    		else
    		{
    			try
				{
	    		 document.getElementById('capa_dsapelb'+i).style.display="";
				 document.getElementById('dsapelb'+i).focus();
				 valor=1;
				 break;
				}
				catch(err)
	  			{
	  			}
	    	}
    	}
    	else
    	{
    		try
			{
    		 document.getElementById('capa_dsmb'+i).style.display="";
			 document.getElementById('dsmb'+i).focus();
			 valor=1;
			 break;
			}
			catch(err)
  			{
  			}
    	}
    }


	if (valor=="") eval(base+"submit()");
}
function valref(forma,total){

	var base="document."+forma+".";
	var i;
    var bError = false;
	var valor="";
    // validacion campos tipo vector

    for (var i=0;i<total;i++) {

    	if (document.getElementById('dsmb'+i).value!="") {

    		if (document.getElementById('dsapelb'+i).value!="") {

    			if (document.getElementById('dstelefono'+i).value!="") {

		    			if (document.getElementById('dsemail'+i).value=="") {

			    			 try
							{
			    			 document.getElementById('capa_dsemail'+i).style.display="";
							 document.getElementById('dsemail'+i).focus();
							 valor=1;
							 break;
							 }
							catch(err)
					  		{
					  		}
		    			}
    			}
    			else
    			{
    				try
					{
	    			document.getElementById('capa_dstelefono'+i).style.display="";
					document.getElementById('dstelefono'+i).focus();
					 valor=1;
					 break;
					 }
					catch(err)
		  			{
		  			}
    			}
    		}
    		else
    		{
    			try
				{
	    		 document.getElementById('capa_dsapelb'+i).style.display="";
				 document.getElementById('dsapelb'+i).focus();
				 valor=1;
				 break;
				}
				catch(err)
	  			{
	  			}
	    	}
    	}
    	else
    	{
    		try
			{
    		 document.getElementById('capa_dsmb'+i).style.display="";
			 document.getElementById('dsmb'+i).focus();
			 valor=1;
			 break;
			}
			catch(err)
  			{
  			}
    	}
    }


	if (valor=="") eval(base+"submit()");
}


function valprof(forma,param,total){
	var base="document."+forma+".";
	partir=param.split(",");
	n=partir.length;
	var i;
    var bError = false;
	var valor="";
    for (i = 0; i < n; i++){
     bError = bError || (eval(base + partir[i] + ".value == ''"));
	 if (bError){
		 document.getElementById('capa_'+partir[i]).style.display="";
		 eval(base + partir[i] + ".focus()");
		 valor=1;
		 break;
     } else {
	 	valor="";
	 }
    }


    for (var i=0;i<total;i++) {

	    if (document.getElementById('dsmb'+i).value!="") {

	    	if (document.getElementById('dsapelb'+i).value!="") {

	    		if (document.getElementById('dstelefonob'+i).value=="") {
	    			try
					{
		    		 document.getElementById('capa_dstelefonob'+i).style.display="";
					 document.getElementById('dstelefonob'+i).focus();
					 valor=1;
					 break;
					}
					catch(err)
		  			{
		  			}
	    		}
	    	}
	    	else{
	    		try
				{
	    		 document.getElementById('capa_dsapelb'+i).style.display="";
				 document.getElementById('dsapelb'+i).focus();
				 valor=1;
				 break;
				}
				catch(err)
	  			{
	  			}
	    	}
	    }
	    else{
		    try
				{
	    		 document.getElementById('capa_dsmb'+i).style.display="";
				 document.getElementById('dsmb'+i).focus();
				 valor=1;
				 break;
				}
				catch(err)
	  			{
	  			}
	    }
    }




       for (var i=0;i<total;i++) {

	    if (document.getElementById('dsmc'+i).value!="") {

	    	if (document.getElementById('dsapelc'+i).value!="") {

	    		if (document.getElementById('dstelefonoc'+i).value=="") {
	    			try
					{
		    		 document.getElementById('capa_dstelefonoc'+i).style.display="";
					 document.getElementById('dstelefonoc'+i).focus();
					 valor=1;
					 break;
					}
					catch(err)
		  			{
		  			}
	    		}
	    	}
	    	else{
	    		try
				{
	    		 document.getElementById('capa_dsapelc'+i).style.display="";
				 document.getElementById('dsapelc'+i).focus();
				 valor=1;
				 break;
				}
				catch(err)
	  			{
	  			}
	    	}
	    }
	    else{
		    try
				{
	    		 document.getElementById('capa_dsmc'+i).style.display="";
				 document.getElementById('dsmc'+i).focus();
				 valor=1;
				 break;
				}
				catch(err)
	  			{
	  			}
	    }
    }

	if (valor=="") eval(base+"submit()");
}

function valgeneral(e) {
	tecla = (document.all) ? e.keyCode : e.which; // 2
	//alert(tecla);
	if (tecla==32) return true; // retorno true para poder dejar  pasar el evento del espacio en blanco con este comando puedo capturar cualquier evento y permitirlo
	if (tecla==8) return true; // 3
	//*patron = /D/; //evita numeros
	patron =/[A-Za-zñÑs0-9]/; // 4 solo admite letras y ñ
	te = String.fromCharCode(tecla); // 5
	return patron.test(te); // 6
}

function carrito_modificar(forma){
	var formabase=eval("document."+forma)
	// validaciones
	formabase.action="modificar.php";
	//formabase.submit();
}
function cambiar(forma){
    document.getElementById('txt_dsciudadenvio').style.display="none";
  var formabase=eval("document."+forma);
  if (formabase.dsciudadenvio.value==""){
    document.getElementById('txt_dsciudadenvio').style.display="";
    formabase.dsciudadenvio.focus();
    return;
  } else {
    partir=formabase.dsciudadenvio.value.split("|");
    idtipoenvio=partir[1];
    var peso=formabase.xpeso.value;
    // cargar Ajax
    	document.getElementById('txt_cargando').style.display='';
 		conexion=AjaxObj();
	//alert("verificar.fletes.php?idtipoenvio="+idtipoenvio+"&peso="+formabase.xpeso.value);
		conexion.open("POST","verificar.fletes.php?idtipoenvio="+idtipoenvio+"&peso="+formabase.xpeso.value,true);
	conexion.onreadystatechange =function() {
		//			alert(conexion.readyState);
			 if (conexion.readyState==4) {
			 var _resultado = conexion.responseText;
			if (_resultado=="0") {
				formabase.xfletes.value=0;
				document.getElementById('txt_cargando').style.display='none';
  			} else {
			document.getElementById('txt_cargando').style.display='none';
			formabase.xfletes.value=(_resultado);
			var total=eval(formabase.xsubtotal.value)-eval(formabase.xdescuento.value)+eval(formabase.xiva.value)+eval(formabase.xfletes.value)+eval(formabase.xvalorseguro.value)+eval(formabase.xvalormanejo.value);
		    formabase.xtotal.value=total;
    		document.getElementById('item_total_valor').innerHTML=total;
  			}

			} // fin conexion
	  } // fin funcion conexion interna
	  conexion.send(null) // limpia conexion


  }


}
function validar_pago(forma){
  var formabase=eval("document."+forma);
  var capabase=document.getElementById('dsciudadenvio');
  if (capabase){
		  if (formabase.dsciudadenvio.value==""){
		    document.getElementById('txt_dsciudadenvio').style.display="";
		    formabase.dsciudadenvio.focus();
		    return;
		  }
	}


if (formabase.dsformadepago.value==""){
    document.getElementById('txt_dsformadepago').style.display="";
    formabase.dsformadepago.focus();
    return;
  }

  formabase.submit();
}

function validar_pago_v2(forma,tipo){
  var formabase=eval("document."+forma);
  var capabase=document.getElementById('dsciudadenvio');
  if (capabase){
		  if (formabase.dsciudadenvio.value==""){
		    document.getElementById('txt_dsciudadenvio').style.display="";
		    formabase.dsciudadenvio.focus();
		    return;
		  }
	}

	if (tipo==0) {
		if (formabase.dsformadepago.value==""){
		    document.getElementById('txt_dsformadepago').style.display="";
		    formabase.dsformadepago.focus();
		    return;
		  }
	} else {
		formabase.dsformadepago.value="1|Punto de Venta|pagos.puntodeventa.php|1";

	}
	formabase.tipotransc.value=tipo;

  formabase.submit();
}

function cambiar_formadepago(forma){
    document.getElementById('txt_dsformadepago').style.display="none";
}

function valFormulario(forma,param,tipo,capa,ruta){
	if (tipo==0)
	{
		var re  = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
		var base="document."+forma+".";
		partir=param.split(",");
		n=partir.length;
		var tam=n-1;
		var i;
		var bError = false;
		var valor="";
		var x;
		var txt="Campo requerido";
		for (i = 0; i < n; i++)
		{
			x=eval(base + partir[i] + ".value");
			x=x.replace(/^\s+/,"");
			bError = bError || (x == "");
			if (bError)
			{

				eval(base + partir[i] + ".value=''");
				document.getElementById('capax_'+partir[i]).innerHTML=txt;
				document.getElementById('capax_'+partir[i]).style.display="";
				eval(base + partir[i] + ".focus()");
				valor=1;
				break;
			}
			else
			{
				valor="";
			}

 if (partir[i]=="idpedido") {
	 	if (isNaN(document.frm_tracking.idpedido.value)) {
	 		document.getElementById('capax_'+partir[i]).style.display="";
			document.getElementById('capax_'+partir[i]).innerHTML="El n&uacute;mero de pedido deber n&uacute;merico";
			 eval(base + partir[i] + ".focus()");
			valor=1;
	 		break;
	 	}

	 }

		}

		// Validacion de correo valido
		if (forma=="frm_registro" || forma=="frm_buscardor") {
			var correobase1=document.getElementById('dscorreo');
			if (correobase1)
			{
			//alert(valor);
				if (!re.test(correobase1.value))
				{
					document.getElementById('capax_dscorreo').innerHTML="El correo no es valido";
					document.getElementById('capax_dscorreo').style.display='';
					correobase1.focus();
					return false;
				}
			}
		}

		if (forma=="frm_suscripcion") {
			var correobasess=document.getElementById('dscorreo_suscrip');
			if (correobasess)
			{
			//alert(valor);
				if (!re.test(correobasess.value))
				{
					document.getElementById('capax_dscorreo_suscrip').innerHTML="El correo no es valido";
					document.getElementById('capax_dscorreo_suscrip').style.display='';
					correobasess.focus();
					return false;
				}
			}
		}

		if (forma=="recomendar")
		{
			var correobase1=document.getElementById('dsemail');
			//var correobase2=document.getElementById('dscorreoc');
			if (correobase1)
			{
			//alert("xx");
				if (!re.test(correobase1.value))
				{
					document.getElementById('capax_dsemail').innerHTML="El correo no es valido";
					document.getElementById('capax_dsemail').style.display='';
					correobase1.focus();
					return false;
				}
			}

			var correobase2=document.getElementById('dsemail2');
			if (correobase2)
			{
				//alert("xx");
				if (!re.test(correobase2.value))
				{
				document.getElementById('capax_dsemail2').innerHTML="El correo no es valido";
				document.getElementById('capax_dsemail2').style.display='';
				correobase2.focus();
				return false;
				}
			}
		}

		if (forma=="frm_registro")
		{
		var contrasena1=document.getElementById('dscontrasena1');
		var contrasena2=document.getElementById('dscontrasena2');
		if (contrasena1.value!=contrasena2.value)
			{
				document.getElementById('capax_dscontrasena2').innerHTML="Ambas contrase&ntilde;as deben ser iguales";
				document.getElementById('capax_dscontrasena2').style.display='';
				contrasena2.value=""
				contrasena2.focus();
				return false;
			}
		}

		if (forma=="frm_actualizar_datos_zona")
		{
		var contrasena1=document.getElementById('dsclave');
		var contrasena2=document.getElementById('dsclave2');
		if (contrasena1.value!=contrasena2.value)
			{
				document.getElementById('capax_dsclave2').innerHTML="Ambas contrase&ntilde;as deben ser iguales";
				document.getElementById('capax_dsclave2').style.display='';
				contrasena2.value=""
				contrasena2.focus();
				return false;
			}
		}


		if(partir[tam]=="captcha"){

			var texto=eval(base + partir[tam] + ".value");
			if (texto!="")
			{
				// cargar cliente y colocar las variables seleccionadas
				//alert(texto);
				//alert(ruta+"captcha/captcha.validar.php?captcha="+texto);
				conexion=AjaxObj();

				conexion.open("POST",ruta+"captcha/captcha.validar.php?captcha="+texto,true);
				conexion.onreadystatechange =function()
				{
					if (conexion.readyState==4)
					{
						var _resultado = conexion.responseText;
						//alert(_resultado);
						if (_resultado==1)
						{
							if(valor=="")eval(base+"submit()");
						}
						else
						{
							document.getElementById('capax_cap').style.display="";
							document.getElementById('captcha').src=ruta+'captcha/captcha.php?'+Math.random();
							eval(base + partir[tam] + ".value=''");
							eval(base + partir[tam] + ".focus()");
							return;
						}
					} // fin funcion
				} // fin conexion
				//contenedor.innerHTML ="";
				conexion.send(null) // limpia conexion
			}
		} else {
			// validaciones adicionales
			var campoAcepto=document.getElementById('dsacepto');
			if (campoAcepto){
				if (campoAcepto.checked==false) {
					document.getElementById('capax_dsacepto').style.display="";
					valor=1;

				}
			}

			if(valor=="")eval(base+"submit()");
		}

	}else if (tipo==1){

		var base=document.getElementById(capa);
		if (base) base.style.display="none";
	}
}

function redirec_combo(formax,ruta,campox) {
	var formabase=eval("document."+formax);
	var campobase=document.getElementById(campox);
	formabase.action=ruta;
	formabase.target="_top";
	formabase.submit();
}

function cambiar_transporte(forma){
    document.getElementById('txt_dsciudadenvio').style.display="none";

  var formabase=eval("document."+forma);
  if (formabase.dsciudadenvio.value==""){

    document.getElementById('item_total_valor_lg').style.display="none";
    document.getElementById('item_total_texto_lg').style.display="none";

    return;
  } else {



    partir=formabase.dsciudadenvio.value.split("|");
    idtipoenvio=partir[1];
    idvalor=partir[2];

    var peso=formabase.xpeso.value;
    // cargar Ajax
	formabase.xtransad.value=(idvalor);
	var total=eval(formabase.xsubtotal.value)-eval(formabase.xdescuento.value)+eval(formabase.xiva.value)+eval(formabase.xfletes.value)+eval(formabase.xvalorseguro.value)+eval(formabase.xvalormanejo.value)+eval(formabase.xtransad.value);
    formabase.xtotal.value=total;

    if(!isNaN(total))
		{
			total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,');
			num = total.split('').reverse().join('').replace(/^[\,]/,'');
		}

    document.getElementById('item_total_valor_lg').style.display="";
    document.getElementById('item_total_texto_lg').style.display="";

	document.getElementById('item_total_valor_lg').innerHTML="$"+num;
  }


}
function val_adicionar(param,ruta)
{
	document.producto_detalle.action=ruta+"adicionar.php?idproducto="+param;

	var tallas = document.getElementById("sel_tallas");
	if (tallas) {
		document.getElementById("sel_tallas_txt").innerHTML="";
		if (tallas.value==""){
			document.getElementById("sel_tallas_txt").innerHTML="Campo requerido *";
			return;

		}
	}

	var colores = document.getElementById("sel_colores");
	if (colores) {
		document.getElementById("sel_colores_txt").innerHTML="";
		if (colores.value==""){
			document.getElementById("sel_colores_txt").innerHTML="Campo requerido *";
			return;

		}
	}
	document.producto_detalle.submit();
}
function apagar_capa(valor){
		document.getElementById(capa).innerHTML="";

}