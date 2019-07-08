function loadJPIE(img) { 
		
	//inc("includes/trans/trans.js");//TRANS

	if(img!=""){
	//alert(img);
	//Here we load the actual image path. TODO: historial path
	historyImages[historyPosition] = img;//asigna la primera imagen
	mainImage.src = ruta + historyImages[historyPosition];//mostrar la imagen en el div
	document.getElementById('canvas').style.display="";
	}else{
		document.getElementById('canvas').style.display="none";
	}
}

//function varible()

var canvas = document.getElementById('canvas');
var mainImage = document.getElementById('mainImage');
var info1 = document.getElementById('info1');
var info2 = document.getElementById('info2');

var lastMouseDown;
var lastMouseUp;
var currentSelection = new Object();
var historyImages = new Array();//crear un arrary para guardar todas las imagenes
var historyPosition = 0;//inicializa la posicion de las imagenes en 0
//var imagePath = "imagenes/editor/";

//Coordinates inside the canvas
var mousePos; // [x,y]

canvas.onmouseup = mouseUp;
canvas.onmousedown = mouseDown;
canvas.onmousemove = mouseMove;

function updateImage(newImg) {
	// Updates history array and loads the current image
	//alert(historyPosition);
	
	historyPosition = historyPosition +1;
	historyImages[historyPosition] = newImg;
	mainImage.src = ruta + historyImages[historyPosition];
	//alert(mainImage.src);
	canvas.width=ruta+newImg.width;
	//imgRatio=mainImage.width/mainImage.height;
	removeSelection();
}

function undo(){//deshacer lo que se hizo
 	//TODO: Controlate the first item
 	//alert(historyPosition);
 	if(historyPosition>0){
	historyPosition = historyPosition - 1;
	mainImage.src = ruta + historyImages[historyPosition];
	removeSelection();	
	}	
}

function redo(){//rehacer
 	//TODO: Controlate the last item
 	var tam=historyImages.length;
  	if(historyPosition<tam-1){
	historyPosition = historyPosition + 1;
	mainImage.src = ruta + historyImages[historyPosition];
	removeSelection();
	}
}
var refresh_function = function(){return false;};

//get mouse coordinate inside de "canvas"
function mouseCoords(ev){
	var top=$(window).scrollTop();
	var left=$(window).scrollLeft();
	
	return {
		x:ev.clientX + left - document.body.clientLeft - getPosition(canvas).x,
		y:ev.clientY + top - document.body.clientTop - getPosition(canvas).y
	}
}


// get position of de "e" object
function getPosition(e){
	var left = 0;
	var top  = 0;

	while (e.offsetParent){
		left += e.offsetLeft;
		top  += e.offsetTop;
		e     = e.offsetParent;
	}

	left += e.offsetLeft;
	top  += e.offsetTop;
	return {x:left, y:top};
}


function mouseMove(ev){
	
	ev       = ev || window.event;
	
	mousePos = mouseCoords(ev);
	
	// Show values in StatusBar
	info1.innerHTML = "X: " + mousePos.x;
	info2.innerHTML = "Y: " + mousePos.y;	
	refresh_function();
	return false;
}



function mouseDown() {
    lastMouseDown = mousePos;
    //alert(lastMouseDown);
   // alert(mousePos);
	create_selection();
	
	refresh_function = refresh_selection;
	return false;
}

function mouseUp() {
	delete_selection();
	lastMouseUp = mousePos;
}

// function removeSelection

function removeSelection() {
	var Node = document.getElementById("selection");
	if (Node!= null) {
		Node.parentNode.removeChild(Node);
	}
	ocultar();
}
// Funcion selección
function create_selection() {
 
	//Remove "selection" node if exists
	removeSelection();
	
	var selection  = document.createElement('div');
	selection.setAttribute('id','selection')
	canvas.appendChild(selection);
	//alert(selection);
	
	selection.style.border = "2px dashed #000000";
	selection.style.position = "absolute";
	selection.style.top = mousePos.y + "px";
	selection.style.left = mousePos.x+ "px";
	selection.style.zIndex = "2";
		
}

var refresh_selection = function() {
	var selection = document.getElementById('selection');
//	alert(mousePos.x);
	var w=(Number(mousePos.x) - Number(lastMouseDown.x));
	var h=(Number(mousePos.y) - Number(lastMouseDown.y));
	var valx=false;//validar la nueva posicion del div hacia arriba
	var valy=false;//validar la nueva posicion del div hacia arriba
	if(w<0 || h<0){
		if(w<0){
			w=w*-1;
			valx=true;
		}
		if(h<0){
			h=h*-1;
			valy=true;
		}
	} 
	/*var wd=document.getElementById('mainImage').style.width;
	var hd=document.getElementById('mainImage').style.height;*/
	
	selection.style.width  = w + "px";
	selection.style.height  = h + "px";
	if(valy)selection.style.top = mousePos.y + "px";
	if(valx)selection.style.left = mousePos.x+ "px";
	
	ev       = ev || window.event;
	var ev;
	mousePos = mouseCoords(ev);
	// Show values in StatusBar
	coordX = mousePos.x;
	coordY = mousePos.y;
	mostrar(selection.style.width,selection.style.height,coordX,coordY);

}

function delete_selection() {
	refresh_function = function(){return false;};
	currentSelection.x = Number(lastMouseDown.x);
	currentSelection.y = Number(lastMouseDown.y);
	currentSelection.width = Number(mousePos.x) - Number(lastMouseDown.x);
	currentSelection.height = Number(mousePos.y) - Number(lastMouseDown.y);
	ocultar();
}

function inc(filename) {
	var body = document.getElementsByTagName('body').item(0);
	script = document.createElement('script');
	script.src = filename;
	script.type = 'text/javascript';
	body.appendChild(script)
}

function callEffect() {
	  http.open("GET", actualURL, true);
	  http.onreadystatechange = handleHttpResponse;
	  //alert(handleHttpResponse);
	  http.send(null);
}

// ---- Funciones AJAX ----
function handleHttpResponse() {
	
  if (http.readyState == 4 && http.status == 200) {
	if ( http.responseText == "Error 500" ) {
		//Error	  
	} else {
		updateImage(http.responseText);

	};
  }
}

function getHTTPObject() {
	var xmlhttp;
	/*@cc_on
	@if (@_jscript_version >= 5)
	try {
	  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
	  try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  } catch (E) {
		xmlhttp = false;
	  }
	}
	@else
	xmlhttp = false;
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
	try {
	  xmlhttp = new XMLHttpRequest();
	} catch (e) {
	  xmlhttp = false;
	}
	}
	return xmlhttp;
}
var http = getHTTPObject(); // We create the HTTP Object

/*   -----------------nuevo----------------- */

function mostrar(coorX,coorY,coordX,coordY)	{//esta fuincion muestra el tamaño de la imagen que desae recortar,la selecc
	//alert(coordX+"  "+coordY);	
	document.getElementById("coordenadas").style.top = coordY + 10;//coordenadas en y de la posicion del mouse
	document.getElementById("coordenadas").style.left = coordX + 10;//cordenadas en x de la posicion del mouse
	document.getElementById("coordenadas").style.visibility = "visible";
	document.getElementById("coordenadas").innerHTML = "x = " + coorX +"<br>y = " + coorY;//cordenadas del area seleccionada
}

function ocultar()	{
	document.getElementById("coordenadas").style.visibility = "hidden";
}

function mostrarcapa(capa,num){
	for(var i=1;i<=num;i++){
	if(i==capa && document.getElementById(capa))document.getElementById(capa).style.display="";
	else document.getElementById(i).style.display="none";
	}
	if(capa==3)posicionimg=historyPosition;
}

/*-------------------------------------------------*/
function crop(rutaImagen){//recortar imagen la ruta es diferente porque se eejcuta en otro directorio
	if(historyImages[historyPosition]+""!="undefined"){
		var h=currentSelection.height;
		var w=currentSelection.width;
		var val=0;
		/*validar si la seleccion fue hacia arriba*/
		if(h<0 && w<0)val=1;
		if(h<0)h=h*-1;
		if(w<0)w=w*-1;
		//alert(currentSelection.x-w);
		if(h>0 && w>0 && document.getElementById("selection")){
			actualURL = "incluidos/cortar.php?x="+currentSelection.x+"&y="+currentSelection.y+"&w="+w+"&h="+h+"&val="+val+"&src=" + historyImages[historyPosition]+"&ruta="+rutaImagen;
			currentSelection.x=null;
			currentSelection.y=null;
			setTimeout("callEffect()", 0); 
		}else{
			//alert("Debe seleccionar un area factible");
		}
	}else{
		//alert("Debe cargar la imagen");
	}
}

function saveImage(rutaImagen){//guardar imagen
	if(historyImages[historyPosition]+""!="undefined"){
	location.href = "incluidos/descargar.php?file="+historyImages[historyPosition]+"&ruta="+rutaImagen;
	}
}

function rotate(img,angulo){
	//alert(historyImages[historyPosition]);
	
	if(historyImages[historyPosition]!=null){//mostrar la nueva imagen
		//openFile.window.close();
		actualURL = "incluidos/rotate.php?x="+angulo+"&src=" + historyImages[historyPosition]+"&ruta="+img;
		setTimeout("callEffect()", 0);
	}
}
function gray(img){
	//alert(historyImages[historyPosition]);
	
	if(historyImages[historyPosition]!=null){//mostrar la nueva imagen
		//openFile.window.close();
		actualURL = "incluidos/gris.php?src=" + historyImages[historyPosition]+"&ruta="+img;
		setTimeout("callEffect()", 0);
	}
}
function bordes(img){
	//alert(historyImages[historyPosition]);

	if(historyImages[historyPosition]!=null){//mostrar la nueva imagen
		//openFile.window.close();
		actualURL = "incluidos/bordes.php?src=" + historyImages[historyPosition]+"&ruta="+img;
		
		setTimeout("callEffect()", 0);
	}
}
/*function color(img){
	//alert(historyImages[historyPosition]);

	if(historyImages[historyPosition]!=null){//mostrar la nueva imagen
		//openFile.window.close();
		actualURL = "incluidos/color.php?src=" + historyImages[historyPosition]+"&ruta="+img;
		
		setTimeout("callEffect()", 0);
	}
}*/
function suavizar(img){
	//alert(historyImages[historyPosition]);

	if(historyImages[historyPosition]!=null){//mostrar la nueva imagen
		//openFile.window.close();
		actualURL = "incluidos/suavizar.php?src=" + historyImages[historyPosition]+"&ruta="+img;
		
		setTimeout("callEffect()", 0);
	}
}

/*terminar este ejercicio*/
function resize(scale_x,scale_y,rutaImg) {

	if(historyImages[historyPosition]+""!="undefined"){
 	if ((scale_x != null) || (scale_y != null)){	 
		actualURL = "incluidos/resize.php?w="+scale_x+"&h="+scale_y+"&src=" + historyImages[historyPosition]+"&ruta="+rutaImg;	
		setTimeout("callEffect()", 0);
	} else {
		//alert("Debe ingresar el nuevo tamaño de la imagen");	
	}
	}else{
		//alert("Debe cargar la imagen");
	}
}

function brillo(br,rutaImg) {
	if(imgorg+""!="undefined"){
 	if ((br != null) && (br != '') && br+""!="undefined"){	 
		actualURL = "incluidos/brillo.php?br="+br+"&ruta="+rutaImg+"&src=" + historyImages[posicionimg];	
		setTimeout("callEffect()", 0);
	} else {
		//alert("Debe ingresar el nuevo tamaño de la imagen");	
	}
	}else{
		//alert("Debe cargar la imagen");
	}
}

function contraste(cr,rutaImg) {
	//alert(historyImages[historyPosition]);
	//alert(cr);
	if(imgorg+""!="undefined"){
 	if ((cr != null) && (cr != '') && cr+""!="undefined"){	 
		actualURL = "incluidos/contraste.php?cr="+cr+"&ruta="+rutaImg+"&src=" + historyImages[posicionimg];	
		setTimeout("callEffect()", 0);
	} else {
		//alert("Debe ingresar el nuevo tamaño de la imagen");	
	}
	}else{
		//alert("Debe cargar la imagen");
	}
}

//validar que solo ingresen numeros
 function misdatos(e) { 
       tecla = (document.all) ? e.keyCode : e.which; 
       if (tecla==8) return true; 
       patron = /[1234567890]/;
       
       te = String.fromCharCode(tecla); 
       return patron.test(te); 
} 

function resizex(rutaImg){	
	if(document.getElementById('y_scale').value!="" || document.getElementById('y_scale').value!=""){
		new_width = document.getElementById('x_scale').value;
		new_height = document.getElementById('y_scale').value;	
		resize(new_width,new_height,rutaImg);	
	}
}

function changeSize(x){
	if (document.getElementById('proportional').checked  == true){
		switch(x){
			case 'w':
				document.getElementById('y_scale').value = Math.floor(document.getElementById('x_scale').value / imgRatio);			
			break;
			case 'h':
				document.getElementById('x_scale').value = Math.floor(document.getElementById('y_scale').value * imgRatio);
			break;
		}	
	}

}
/*para el brillo*/
function mouseCoordsx(ev,rutaImg){
	var mm=document.getElementById("barrabrillo");
	document.getElementById("imgbrillo").style.left=ev.clientX;
	var br=ev.clientX-getPosition(mm).x-100;
	brillo(br,rutaImg)
}

function moverImagen(ev,idimg){
	//var posicion=mouseCoords(ev);
	document.getElementById(idimg).style.left=ev.clientX;
	//alert(posicion.x);
}
/*contraste*/
function mouseCoordsc(ev,rutaImg){
	var mm=document.getElementById("barrabrilloc");
	document.getElementById("imgcontraste").style.left=ev.clientX;
	var br=ev.clientX-getPosition(mm).x-100;
	//document.getElementById('contraste').style.left=ev.clientX;
	contraste(br,rutaImg)
}

/*function moverImagenc(ev){
	var posicion=mouseCoords(ev);
	document.getElementById('botonc').style.width=posicion.x;
	//document.getElementById('contraste').style.left=posicion.x;
	//alert(posicion.x);
}*/
