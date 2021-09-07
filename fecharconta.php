<?php 
/**
*Author: Lopes Carlos Joaquim
*E-mail: lopescarloshtmljs@gmail.com / 940542657
*Local: Angola/Luanda/Viana/Gean Piaget/famosa
**/
include_once("fonte/documentos/certificado.php");
if(isset($_GET["destroi"]) && $_GET["destroi"] == "sim"){
  unset($_SESSION["usuario"]);
	$zerro = "null";
	setcookie("user",$zerro,time()+3600*24*7,"www");
	header("location: fecharconta.php?modo=off");	
}
if(isset($_GET["modo"]) and $_GET["modo"] == "off"){
  unset($_SESSION["usuario"]);
	$zerro = "null";
	setcookie("user",$zerro,time()+3600*24*7,"www");
	header("location: index.php");
}
if(isset($_SESSION["usuario"])){
  echo "<script>
  var fechar = confirm('Tens a certeza!');
  if(fechar == true){
  		location.href='fecharconta.php?destroi=sim';
  }
  else {
  	window.history.back();
  }
  </script>";
}
/**
* Vitae informações sobre o programador *

* Nome: Lopes Carlos Joaquim
* Contacto: 940542653 / lopescarloshtmljs@gmail.com

* Especialista em: *
* Informatica, programação web, eletricidade auto, eletronica , Hardwere e Softwere, comercio.

* Areas dominadas: *
* Word Excel photoshop, PHP JavaScript Bootstrap html css, estalação basica reparação de aparelhos eletrobico e computadores , comercio e atendimento publico

* Estudos e focus *
* Ingles, c# , lingua portuguêsa, framework
* trabalhar e aprender é o meu foco.
**/
?>