<?php
if($certificado->tipo_de_site == "Banda Desenhada"){
	if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "upload" and isset($_SESSION["usuario"])){
			
	echo "
	<html class='h-100'>
  		<body class='d-flex h-100 text-center'>
			<div class='cover-container d-flex w-100 h-100 p-3 mx-auto flex-column'>
  				<header class='mb-auto'>
  					
    				
  				</header>";
  		
				
					include_once("fonte/pacote/incluindo.php");
					
				echo "
				<main class='px-3'>
				<div class=' color-white btn bg-light justify-content-center' id=''>
				<div class='container'>
				<h4 class='text4 color-info'>Carregar nova serrie</h4><hr>
				<div class='grupo-mdm-3 m-c m-b' id=''>
				</div>
				<form action='publicidade.php?conteudo=upload&entrar=cadastro' method='post' enctype='multipart/form-data'>
				<div class='grupo-mdm-3 m-c m-b'>
				<label class='form-control'>Imagem de capa</label>
				<input type='file' name='arquivo' class='form-control me-2' placeholder='Nome do usuario' id='nome' value=";if(isset($_SESSION['arquivo'])){echo $_SESSION['arquivo'];} echo "required>
				</div><hr>
				<div class='grupo-mdm-3 m-c m-b'>
				<label class='form-control'>titulo do conteudo</label>
				<textarea type='titulo' name='titulo' class='form-control me-2' id='exampleFormControlInput2' placeholder='ex: temporada 1 epsodio 1' value=";if(isset($_SESSION['titulo'])){echo $_SESSION['titulo'];} echo "required></textarea>
				</div>
				<div class='grupo-mdm-3 m-c m-b'>
				<input type='submit' value='confirmar' class='form-control btn btn-outline-primary ' name='confirmar'>
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
 }else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "itens" and isset($_SESSION["usuario"])){
 	//exibir area de publicar itens de capa em privacidade
 	echo "
 	<section class='text-center'>";
 	if(isset($_GET["conteudo"])){
 	$pegartabelausuariologado = "select * from AlbumCapa where usuarioAlbum = '$_SESSION[usuario]' order by idAlbum desc limit 10";
 	$preparartbusuariologado = $certificado->bd->query($pegartabelausuariologado) or die ($certificado->bd->error);
 	$totalcapas = $preparartbusuariologado->num_rows;
 	if(strlen($totalcapas) <= 0){
 		//redirecionar usuario que tenta carregar itens em publicidade... bd
 		header("location: erros.php?");
 	}
 	
 	echo "
 	<div class='album bg-light'>
 	<div class='container-fluid'>
 	<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>";
 	while($verAlbumCapa = $preparartbusuariologado->fetch_array()){
 	//percorrer todas img e mostrar na tela inicial da banda desenhada da tabela AlbumCapa
 	echo "
 	<div class='col' id='hid5'>
 	<div class='card shadow-sm'>
 	<a href='index.php?conteudo=image&banda=$verAlbumCapa[idAlbum]&ver=capa'>";
 	if(is_file("fonte/galeria/$verAlbumCapa[imgAlbum]")){
 	echo "<img src='fonte/galeria/$verAlbumCapa[imgAlbum]' class='bd-placeholder-img card-img-top' width='100%' height='225'>";
 	}
 	if(!is_file("fonte/galeria/$verAlbumCapa[imgAlbum]")){
 	echo "<img src='fonte/img/logotipo.svg' class='bd-placeholder-img card-img-top' width='100%' height='225'>";
 	}
 	echo "
 	</a>
 	
 	<div class='card-body'>
 	<p class='card-text'>$verAlbumCapa[textoAlbum]</p>
 	<div class='d-flex justify-content-between align-items-center'>
 	<div class='btn-group'>
 	<form action='publicidade.php?conteudo=itemupload&hid=$verAlbumCapa[idAlbum]' method='post'>
 	<input type='hidden' name='itemvai' value='$verAlbumCapa[textoAlbum]'>
 	<input type='hidden' name='itemid' value='$verAlbumCapa[idAlbum]'>
 	<button type='submit' class='btn btn-sm btn-outline-secondary'>carregar</button>
 	</form>
 	<form action='publicidade.php?conteudo=curtir&hid=$verAlbumCapa[idAlbum]' method='post'>
 	<input type='hidden' name='serrie' value='$verAlbumCapa[idAlbum]'>
 	<input type='hidden' name='conteudo' value='$verAlbumCapa[imgAlbum]'>
 	<input type='hidden' name='curtir' value='$verAlbumCapa[idAlbum]'>
 	<input type='hidden' name='modulo' value='capa'>
 	<button type='submit' class='btn btn-sm btn-outline-secondary'>editar</button>
 	</form>
 	</div>
 	<small class='text-muted'>excluir</small>
 	</div>
 	</div>
 	</div>
 	</div>";
 	}
 	echo "
 	</div>
 	</div>
 	</div></section>";
 	
 	}
 
 }else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "itemupload" and isset($_GET["hid"])){
 	echo "
 	<html class='h-100'>
 	<body class='d-flex h-100 text-center'>
 	<div class='cover-container d-flex w-100 h-100 p-3 mx-auto flex-column'>
 	<header class='mb-auto'>
 	
 	
 	</header>";
 	
 	
 	include_once("fonte/pacote/incluindo.php");
 	
 	echo "
 	<main class='px-3'>
 	<div class=' color-white btn bg-light justify-content-center' id=''>
 	<div class='container'>
 	<h4 class='text-4 color-info'>Carregar item da serrie</h4><hr>
 	<div class='grupo-mdm-3 m-c m-b' id=''>
 	</div>
 	<form action='publicidade.php?conteudo=itemupload&hid=$_GET[hid]' method='post' enctype='multipart/form-data'>
 	<div class='grupo-mdm-3 m-c m-b'>
 	<label class='form-control'>Carregar Nova Imagem</label>
 	<input type='file' name='arquivo' class='form-control me-2' placeholder='Nome do usuario' id='nome' value=";if(isset($_SESSION['arquivo'])){echo $_SESSION['arquivo'];} echo "required>
 	</div><hr>
 	<div class='grupo-mdm-3 m-c m-b'>
 	<label class='form-control'>titulo do item </label>
 	<textarea type='titulo' name='titulo' class='form-control me-2' id='exampleFormControlInput2' placeholder='ex: temporada 1 epsodio 1' value=";if(isset($_SESSION['titulo'])){echo $_SESSION['titulo'];} echo "required></textarea>
 	</div>
 	<div class='grupo-mdm-3 m-c m-b'>
 	<input type='submit' value='confirmar item' class='form-control btn btn-outline-primary ' name='confirmar'>
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
 }
 ?>