<?php
include_once("fonte/documentos/certificado.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aprenda a desenvolver web-sites sem saber programação aprnas com o soudev da fbsuper">
    <meta name="author" content="Lopes Carlos Joaquim">
    <meta name="generator" content="SouDev 1.1">
    <title>Usuario conectando-se</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">
	<link href="boots/css/bootstrap.min.css" rel="stylesheet">
    <link href="boots/css/cover.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
	<link href="carousel.css" rel="stylesheet">
  </head>
  <body>
  	<?php
  	if($certificado->erro_do_banco != "Sim"){
  	
    if($certificado->mostrar_cabecalho == "Sim"){
    	include_once("fonte/pacote/menucabecalho.php");
    }
    ?><br><br><br><br>
	<?php
	
	if(!isset($_GET["registrar"])){
	//mostrar tela de login de usuario
	echo "
	<html class='h-100'>
	<body class='d-flex h-100 text-center'>
	<div class='cover-container d-flex w-100 h-100 p-3 mx-auto flex-column'>
	<header class='mb-auto'>
	
	
	</header>";
	
	
	echo "
	<main class='px-3'>
	<div class=' color-white btn bg-light justify-content-center' id=''>
	<div class='container'>
	<h4 class='text4 color-info'>Iniciar Sessão</h4><hr>
	<div class='grupo-mdm-3 m-c m-b' id=''>";
	include_once("fonte/pacote/incluindo.php");
	
	echo "
	</div>
	<form action='usuario.php?usuario=login' method='post' enctype='multipart/form-data'>
	<div class='grupo-mdm-3 m-c m-b'>
	<label class='form-control'>G-mail ou Número</label>
	<input type='email' name='email' class='form-control me-2' placeholder='lopescarloshtmljs@gmail.com' id='nome'  required='true' value='";if(isset($_POST['email'])){echo "$_POST[email]";}echo"'>
	</div><hr>
	<div class='grupo-mdm-3 m-c m-b'>
	<label class='form-control'>Palavra Passe</label>
	<input type='password' name='senha' class='form-control me-2' id='exampleFormControlInput2' placeholder='******' required>
	</div>
	<div class='grupo-mdm-3 m-c m-b'>
	<input type='submit' value='confirmar' class='form-control btn btn-outline-primary ' name='cmtlogin'>
	</div>
	<div class='form-control mt-3 mb-3'>
	<a href=''class='link'>Recuperar Senha</a>&nbsp;
	<a href='usuario.php?registrar=usuario' class='btn btn-outline-success'>Registar-se</a>
	</div>
	
	</form>
	</div>
	</div>
	</main>";
	
	echo "
	<footer class='mt-auto text-white-50'>";
	include_once("fonte/pacote/menurodape.php");
	echo "
	</footer>
	</div>
	</body>
	</html>";
	}else {
	//mostrar tela de registro de usuario
	echo "
	<html class='h-100'>
	<body class='d-flex h-100 text-center'>
	<div class='cover-container d-flex w-100 h-100 p-3 mx-auto flex-column'>
	<header class='mb-auto'>
	
	
	</header>
	<br><br>
	<main class='px-2'>
	<div class=' color-white btn bg-light justify-content-center' id=''>
	<div class='container-fluid'>
	<h4 class='text4 color-info'>Criar Conta</h4><hr>
	<div class='grupo-mdm-3 m-c m-b' id=''>
	";
	
	
	include_once("fonte/pacote/incluindo.php");
	
	echo "
	</div>
	<form action='usuario.php?registrar=usuario' method='post' enctype='multipart/form-data'>
	<div class='grupo-mdm-3 m-c m-b'>
	<label class='form-control'>Nome Completo</label>
	<input type='text-name' name='nome' class='form-control me-2' placeholder='lopescarloshtmljs@gmail.com' id='nome' required>
	</div><hr>
	<div class='grupo-mdm-3 m-c m-b'>
	<label class='form-control'>G-mail </label>
	<input type='email' name='email' class='form-control me-2' placeholder='lopescarloshtmljs@gmail.com' id='nome' required>
	</div><hr>
	<div class='grupo-mdm-3 m-c m-b'>
	<label class='form-control'>Número</label>
	<input type='number' name='numero' class='form-control me-2' placeholder='lopescarloshtmljs@gmail.com' id='nome' required>
	</div><hr>
	<div class='grupo-mdm-3 m-c m-b'>
	<label class='form-control'>Palavra Passe</label>
	<input type='password' name='senha' class='form-control me-2' placeholder='******' id='nome' required>
	</div><hr>
	<div class='grupo-mdm-3 m-c m-b'>
	<label class='form-control'>Confirmar Senha</label>
	<input type='password' name='rsenha' class='form-control me-2' id='exampleFormControlInput2' placeholder='******' required>
	</div>
	<div class='grupo-mdm-3 m-c m-b'>
	<input type='submit' value='Cadastrar-se' class='form-control btn btn-outline-primary ' name='confirmar'>
	</div>
	
	</form>
	</div>
	</div>
	</main>";
	
	echo "
	<footer class='mt-auto text-white-50'>";
	include_once("fonte/pacote/menurodape.php");
	echo "
	</footer>
	</div>
	</body>
	</html>";
	
	}
	?>
	<?php
	
	?><br><br><br>
	<footer>
	<?php
	if($certificado->mostrar_rodape == "Sim"){
		include_once("fonte/pacote/menurodape.php");
	}
	}else{
		include_once("fonte/pacote/erros.php");
	}
	?>
	</footer>
    <script src="boots/js/bootstrap.bundle.min.js"></script>
    <script src="fonte/js/fbsuper.custom.js"></script>
  </body>
</html>