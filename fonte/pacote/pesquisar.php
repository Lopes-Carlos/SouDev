
<?php
if(isset($_GET["buscar"]) and strlen($_GET["buscar"]) >= 1){
 	//exibir area de publicar itens de capa em privacidade
 	$buscar = trim(htmlspecialchars(strip_tags(filter_input(INPUT_GET,"buscar",FILTER_SANITIZE_STRING))));
 	echo "
 	<section class='text-center'>";
 	if(isset($buscar)){
 	//pegar dados do albumcapa na area de buscas...
 	$pegartabelausuariologado = "select * from AlbumCapa where textoAlbum LIKE '%$buscar%' order by idAlbum desc limit 10";
 	$preparartbusuariologado = $certificado->bd->query($pegartabelausuariologado) or die ($certificado->bd->error);
 	$totalcapas = $preparartbusuariologado->num_rows;
 	//pegar dados do albumcapa na area de buscas...
 	$pegartabelausuariologados = "select * from AlbumItens where textoItem LIKE '%$buscar%' order by idItem desc limit 10";
 	$preparartbusuariologados = $certificado->bd->query($pegartabelausuariologados) or die ($certificado->bd->error);
 	$totalcapass = $preparartbusuariologados->num_rows;
 	if(strlen($totalcapas) <= 0){
 		//redirecionar usuario que tenta carregar itens em publicidade... bd
 		header("location: erros.php?");
 	}
 	$totalresultado = $totalcapas + $totalcapass;
 	echo "
 	<div class='album bg-light'>
 	<div class='container-fluid'>
 	<div>Encontrado: $totalresultado Resultados</div>
 	<br><hr>";
 	
 	if($totalcapas){
 	echo "
 	<div class='bg-info text-dark'>Ver Capas De Album: $totalcapas Resultados</div>
 	";
 	}
 	echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>";
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
 	<form action='index.php?conteudo=banda' method='get'>
 	<input type='hidden' name='conteudo' value='banda'>
 	<input type='hidden' name='banda' value='$verAlbumCapa[idAlbum]'>
 	<button type='submit' class='btn btn-sm btn-outline-secondary'>Abrir</button>
 	</form>
 	<form action='index.php?conteudo=curtir&hid=$verAlbumCapa[idAlbum]' method='post'>
 	<input type='hidden' name='serrie' value='$verAlbumCapa[idAlbum]'>
 	<input type='hidden' name='conteudo' value='$verAlbumCapa[imgAlbum]'>
 	<input type='hidden' name='curtir' value='$verAlbumCapa[idAlbum]'>
 	<input type='hidden' name='modulo' value='capa'>
 	<button type='submit' class='btn btn-sm btn-outline-secondary'>Curtir</button>
 	</form>
 	</div>
 	<small class='text-muted'>$verAlbumCapa[dataAlbum]</small>
 	</div>
 	</div>
 	</div>
 	</div>";
 	}
 	echo "
 	</div><br><hr>";
 	if($totalcapass){
 		echo "<div class='bg-info text-dark'>Ver Itens De Capa: $totalcapass Resultados</div>";
 	}
 	echo "
 	<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>";
 	while($verAlbumCapas = $preparartbusuariologados->fetch_array()){
 	//percorrer todas img e mostrar na tela inicial da banda desenhada da tabela AlbumCapa
 	echo "
 	<div class='col' id='hid5'>
 	<div class='card shadow-sm'>
 	<a href='index.php?conteudo=image&banda=$verAlbumCapas[idItem]&ver=item'>";
 	if(is_file("fonte/galeria/$verAlbumCapas[imgItem]")){
 	echo "<img src='fonte/galeria/$verAlbumCapas[imgItem]' class='bd-placeholder-img card-img-top' width='100%' height='225'>";
 	}
 	if(!is_file("fonte/galeria/$verAlbumCapas[imgItem]")){
 	echo "<img src='fonte/img/logotipo.svg' class='bd-placeholder-img card-img-top' width='100%' height='225'>";
 	}
 	echo "
 	</a>
 	
 	<div class='card-body'>
 	<p class='card-text'>$verAlbumCapas[textoItem]</p>
 	<div class='d-flex justify-content-between align-items-center'>
 	<div class='btn-group'>
 	
 	<form action='pesquisas.php?buscar=$buscar&banda=$verAlbumCapas[idCapaItem]#ip$verAlbumCapas[idItem]' method='post'>
 	<input type='hidden' name='conteudo' value='banda'>
 	<input type='hidden' name='baixar' value='$verAlbumCapas[textoItem]'>
 	<input type='hidden' name='iditem' value='$verAlbumCapas[idItem]'>
 	<input type='hidden' name='idcapa' value='$verAlbumCapas[idCapaItem]'>";
 	if(!isset($_POST['baixar']) or isset($_POST['baixar']) and $_POST['baixar'] != $verAlbumCapas["textoItem"]){
 	echo "
 	<button type='submit' class='btn btn-sm btn-outline-secondary'>Baixar</button>";
 	}
 	if(isset($_POST['baixar']) and $_POST['baixar'] == $verAlbumCapas["textoItem"]){
 	//baixar
 	//metodo de curtição da pagina inicial... capa e item
 	$tbcurtiralbum = "insert into AlbumBaixar(idCurtirAlbum,imgCurtirAlbum,moduloCurtirAlbum,idCurtirItemAlbum,dataCurtirAlbum,horaCurtirAlbum,tempoCurtirAlbum) value(null,'$_POST[iditem]','baixadoImg','$_POST[idcapa]',NOW(),NOW(),NOW())";
 	$analisarlikealbum = $certificado->bd->query($tbcurtiralbum) or die ($certificado->bd->error);
 	if($analisarlikealbum == true){
 	}
 	echo "
 	<a href='fonte/galeria/$verAlbumCapas[imgItem]' class='btn btn-sm btn-outline-primary' download>Agora</a>";
 	
 	}
 	echo "
 	</form>
 	
 	
 	<form action='index.php?conteudo=curtir&hid=$verAlbumCapas[idItem]' method='post'>
 	<input type='hidden' name='serrie' value='$verAlbumCapas[idCapaItem]'>
 	<input type='hidden' name='conteudo' value='$verAlbumCapas[imgItem]'>
 	<input type='hidden' name='curtir' value='$verAlbumCapas[idItem]'>
 	<input type='hidden' name='modulo' value='item'>
 	<button type='submit' class='btn btn-sm btn-outline-secondary'>Curtir</button>
 	</form>";
 	if(isset($_SESSION["usuario"]) and $_SESSION["usuario"] == $verAlbumCapas["idUsuarioItem"]){
 	echo "
 	<form action='index.php?conteudo=updateitem&hid=$verAlbumCapas[idCapaItem]' method='post'>
 	<input type='hidden' value='$verAlbumCapas[idItem]' class='dp-none' name='hid'>
 	<input type='hidden' value='$verAlbumCapas[idItem]' class='dp-none' name='id'>
 	<input type='hidden' value='$verAlbumCapas[imgItem]' class='dp-none' name='conteudo'>
 	<input type='hidden' value='$verAlbumCapas[idUsuarioItem]' class='dp-none' name='idusuario'>
 	<button type='submit' class='btn btn-sm btn-outline-primary' name='confirmar'>Editar</button>
 	
 	</form>
 	";
 	}
 	
 	
 	
 	echo "
 	
 	</div>
 	<small class='text-muted'>excluir</small>
 	</div>
 	</div>
 	</div>
 	</div>";
 	}
 	echo "
 	</div><br><hr>
 	</div>
 	<br><hr>
 	</div></section>";
 	
 	}
 
 }
 
 ?>