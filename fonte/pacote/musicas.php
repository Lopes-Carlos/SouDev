<?php
if(!isset($_GET["conteudo"])){
//ver dados musicas si não aver click na tela inicial e gets
$pagina = isset($_GET["pagina"])?trim(strip_tags(filter_input(INPUT_GET,"pagina",FILTER_SANITIZE_INT))):"0";
$local =  isset($_GET["pagina"])?trim(strip_tags(filter_input(INPUT_GET,"local",FILTER_SANITIZE_INT))):"10";
$pegartabelausuariologado = "select * from AlbumCapa order by idAlbum desc limit $pagina,$local";
$preparartbusuariologado = $certificado->bd->query($pegartabelausuariologado) or die ($certificado->bd->error);				
if($certificado->mostrar_forma_musicas == "Colunas"){
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
						<div class=''>
							<audio controls='controls' width='50px'>
								<source src='m.mp3' width='50px'/>
							</audio>
						</div>
						<p class='card-text'>$verAlbumCapa[textoAlbum]</p>
						<div class='d-flex justify-content-between align-items-center'>
							<div class='btn-group'>
								<form action='index.php?conteudo=banda' method='get'>
									<input type='hidden' name='conteudo' value='banda'>
									<input type='hidden' name='banda' value='$verAlbumCapa[idAlbum]'>
									<button type='submit' class='btn btn-sm btn-outline-secondary'>Baixar</button>
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
		</div>
	</div>
</div>";
}else if($certificado->mostrar_forma_musicas == "Listas"){
echo "
<div class='album bg-light'>
	<div class='container-fluid'>
		<div class='row row-cols-1 g-1'>";
		while($verAlbumCapa = $preparartbusuariologado->fetch_array()){
			echo "
			<div class='col d-flex' id='hid'>
				<div class='card shadow-sm col-4 d-none d-tb-block d-sm-block d-pc-block'>
					<a href='index.php?conteudo=image&banda=$verAlbumCapa[idAlbum]&ver=capa'>";
						if(is_file("fonte/galeria/$verAlbumCapa[imgAlbum]")){
							echo "<img src='fonte/galeria/$verAlbumCapa[imgAlbum]' class='bd-placeholder-img card-img-top' width='200' height='200'>";
						}
						if(!is_file("fonte/galeria/$verAlbumCapa[imgAlbum]")){
							echo "<img src='fonte/img/logotipo.svg' class='bd-placeholder-img card-img-top' width='200' height='200'>";
						}
					echo "
					</a>
				</div>
				<div class='card-body' id=$verAlbumCapa[idAlbum]'>
					<div class=''>
						<audio controls='controls' width='50px'>
							<source src='m.mp3' width='50px'/>
						</audio>
					</div>
					<p class='card-text'>$verAlbumCapa[textoAlbum]</p>
					<div class='d-flex col-pc-4 col-sm-6 col-tb-10 justify-content-between align-items-center'>
						<div class='btn-group'>
							<form action='index.php' method='post'>
							<input type='hidden' name='conteudo' value='banda'>
							<input type='hidden' name='baixar' value='$verAlbumCapa[textoAlbum]'>
							<input type='hidden' name='idcapa' value='$verAlbumCapa[idAlbum] '>";
							if(!isset($_POST['baixar']) or isset($_POST['baixar']) and $_POST['baixar'] != $verAlbumCapa["textoAlbum"]){
								echo "<button type='submit' class='btn btn-sm btn-outline-secondary'>Baixar</button>";
							}
							if(isset($_POST['baixar']) and $_POST['baixar'] == $verAlbumCapa["textoAlbum"]){
								//metodo de curtição da pagina inicial... capa e item
								$tbcurtiralbum = "insert into AlbumBaixar(idCurtirAlbum,imgCurtirAlbum,moduloCurtirAlbum,idCurtirItemAlbum,dataCurtirAlbum,horaCurtirAlbum,tempoCurtirAlbum) value(null,'$_POST[idcapa]','baixadoMusic','$_POST[idcapa]',NOW(),NOW(),NOW())";
								$analisarlikealbum = $certificado->bd->query($tbcurtiralbum) or die ($certificado->bd->error);
								echo "<a href='fonte/galeria/$verAlbumCapa[imgAlbum]' class='btn btn-sm btn-outline-primary' download>Agora</a>";
							}
							echo "
							</form>
							<form action='index.php?hid=$verAlbumCapa[idAlbum]' method='post'>
								<input type='hidden' name='serrie' value='$verAlbumCapa[idAlbum]'>
								<input type='hidden' name='conteudo' value='$verAlbumCapa[imgAlbum]'>
								<input type='hidden' name='curtir' value='$verAlbumCapa[idAlbum]'>
								<input type='hidden' name='modulo' value='musica'>
								<button type='submit' class='btn btn-sm btn-outline-secondary'>Curtir</button>";
								if(isset($_POST["modulo"]) and $_POST["modulo"] == "musica" and is_numeric($_GET["hid"]) and $_GET["hid"] >= 1){
									//curtir Musica, icone da serrie...
									if($certificado->tipo_de_site == "Musicas"){
										$idserrie = trim(strip_tags(filter_input(INPUT_POST,"serrie", FILTER_VALIDATE_INT)));
										$idcurtir = trim(strip_tags(filter_input(INPUT_POST,"curtir", FILTER_VALIDATE_INT)));
										$imgcurtir = trim(strip_tags(filter_input(INPUT_POST,"conteudo", FILTER_SANITIZE_STRING)));
										$modulocurtir = trim(strip_tags(filter_input(INPUT_POST,"modulo", FILTER_SANITIZE_STRING)));
										if(isset($_POST["curtir"]) and $_POST["curtir"] == $verAlbumCapa["idAlbum"]){
											//metodo de curtição da pagina inicial... capa e item
											$tbcurtiralbum = "insert into AlbumCurtir(idCurtirAlbum,imgCurtirAlbum,moduloCurtirAlbum,idCurtirItemAlbum,dataCurtirAlbum,horaCurtirAlbum,tempoCurtirAlbum) value(null,'$imgcurtir','$modulocurtir','$idcurtir',NOW(),NOW(),NOW())";
											$analisarlikealbum = $certificado->bd->query($tbcurtiralbum) or die ($certificado->bd->error);
											if($analisarlikealbum == true){
											}
										}
									}
								}
								echo "
							</form>
						</div>
						<small class='text-muted'>$verAlbumCapa[dataAlbum]</small>
					</div>
				</div>
			</div>
			";
 	    }
 	    //botão de visualização back next um salto na musica
 	    if(isset($totalcmt)){
 	    $mais = $paginic + 9;
 	    $menos = $paginic - 9;		
 	    if($totmusic >= 10){
 	    if($paginic != 0){
 	    echo "<div class='fm'>
 	    <div class='gp-mdm-3 j-mdm-l'>
 	    <a href='musicas.php?pagina=$menos' class='cb p bp ttl3 m-d' id='tirar' onclick='tirar()'><i class='fas cl fa-arrow-circle-left'></i> anterior</a><br>
 	    </div>
 	    </div>";
 	    }
 	    if($paginic <= $totmusic){
 	    echo "<div class='fm'>
 	    <div class='gp-mdm-3 j-mdm-l'>
 	    <a href='musicas.php?pagina=$mais' class='cb p bp ttl3 m-e' id='pular' onclick='pular()'><i class='fas cl fa-arrow-circle-right'></i> proximo</a><br>
 	    </div>
 	    </div>";
 	    }
 	    }
 	    }
 	    
		echo "
		</div>
	</div>
</div>
";
}
}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "image" and is_numeric($_GET["banda"]) and $_GET["banda"] >= 1 and $_GET["ver"] == true){
	//exibir imagem de capa ou item numa janela customisada... caso do usuario clicar na imagem. ver na pagina inicial para banda desenhada
	$idBanda = trim(strip_tags(filter_input(INPUT_GET,"banda",FILTER_VALIDATE_INT)));
	if($_GET["ver"] == "capa"){
	//exibir imagem caso o click seja da capa na pagina inicial
	$pegartabelausuariologadoo = "select * from AlbumCapa where idAlbum = '$idBanda' limit 1";
	$preparartbusuariologadoo = $certificado->bd->query($pegartabelausuariologadoo) or die ($certificado->bd->error);
	$verCapa = $preparartbusuariologadoo->fetch_array();
	echo "
	<div class=''>";
		if(is_file("fonte/galeria/$verCapa[imgAlbum]")){
			echo "<img src='fonte/galeria/$verCapa[imgAlbum]' class='container-fluid' height='100%'>";
		}else{
			echo "<img src='fonte/img/logotipo.svg' class='bd-placeholder-img card-img-top' width='100%' height='100%'>";
		}
		//pegar dados registado da capa ou seja conteudo inicial capa
		$tabelacurtir = "select * from AlbumCurtir where idCurtirItemAlbum = '$idBanda' and moduloCurtirAlbum = 'musica'";
		$confirmarcurtir = $certificado->bd->query($tabelacurtir) or die($certificado->bd->error);
		$pegarcurtir = $confirmarcurtir->fetch_array();
		$totalcurtir = $confirmarcurtir->num_rows;
		//pegar dados de download realisado e mostrar a totalidade
		$tabelabaixar = "select * from AlbumBaixar where imgCurtirAlbum = '$idBanda' and moduloCurtirAlbum= 'baixadoMusic'";
		$confirmarbaixar = $certificado->bd->query($tabelabaixar) or die($certificado->bd->error);
		$pegarbaixar = $confirmarbaixar->fetch_array();
		$totalbaixar = $confirmarbaixar->num_rows;
		echo "
		</div>
		<div class='d-flex justify-content-center m-1 row'>
			<div class='col-6'>
				Curtidas: $totalcurtir vezes<br>
				Baixadas: $totalbaixar vezes
			</div>
			<div class='col-6'>
				unidade: $idBanda idMusic
			</div>
		</div>
	";
	}
}
?>