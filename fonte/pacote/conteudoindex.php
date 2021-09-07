<?php
if($certificado->tipo_de_site == "Banda Desenhada"){
	echo "
	<section class='text-center'>";
	if(!isset($_GET["conteudo"])){
				$pegartabelausuariologado = "select * from AlbumCapa order by idAlbum desc limit 10";
				$preparartbusuariologado = $certificado->bd->query($pegartabelausuariologado) or die ($certificado->bd->error);
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
				</div>
				</div>
				</div>";
				
			}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "banda" and is_numeric($_GET["banda"]) and $_GET["banda"] >= 1){
				//exibir conteudo exibido em caso do usuario clicar em ver na pagina inicial para banda desenhada
				$idBanda = trim(strip_tags(filter_input(INPUT_GET,"banda",FILTER_VALIDATE_INT)));
				$pegartabelausuariologadoo = "select * from AlbumCapa where idAlbum = '$idBanda' limit 1";
				$preparartbusuariologadoo = $certificado->bd->query($pegartabelausuariologadoo) or die ($certificado->bd->error);
				$verCapa = $preparartbusuariologadoo->fetch_array();
				echo "
				<div class=''>";
				if(is_file("fonte/galeria/$verCapa[imgAlbum]")){
					echo "<img src='fonte/galeria/$verCapa[imgAlbum]' class='container-fluid' height='225'>";
				}else{
					echo "<img src='fonte/img/logotipo.svg' class='bd-placeholder-img card-img-top' width='100%' height='225'>";
				}
				echo "
				<div class='text-info'>
					<div class=' m-3 bg-dark'>
					$verCapa[textoAlbum]<br>";
					if(isset($_SESSION["usuario"]) and $_SESSION["usuario"] == $verCapa["usuarioAlbum"]){
					//botão que leva para formulario para editar capaAlbum na pagina inicial
					echo "
					<form action='index.php?conteudo=updatecapa&hid=$verCapa[idAlbum]' method='post'>
					<div class='container'>
					<input type='hidden' value='$verCapa[idAlbum]' class='dp-none' name='hid'>
					<input type='hidden' value='$verCapa[imgAlbum]' class='dp-none' name='conteudo'>
					<input type='hidden' value='$verCapa[usuarioAlbum]' class='dp-none' name='idusuario'>
					<input type='submit' value='Editar Conteudo' class='form-control btn btn-outline-primary ' name='confirmar'>
					</div>
					</form>
					";
					}
					echo "
					</div>
				
				</div>
				
				</div>
				<br><br>
				<div class='album bg-light'>
				<div class='container-fluid'>
				<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>
				";
				$pegartabelausuariologado = "select * from AlbumItens where idCapaItem = '$idBanda' order by idItem desc limit 10";
				$preparartbusuariologado = $certificado->bd->query($pegartabelausuariologado) or die ($certificado->bd->error);
				while($verItemCapa = $preparartbusuariologado->fetch_array()){
				//percorrer todas img e mostrar na tela inicial da banda desenhada da tabela AlbumItens
				echo "
				<div class=''>
					<div class='card shadow-sm'>
						<a href='index.php?conteudo=image&banda=$verItemCapa[idItem]&ver=item' id='hid$idBanda'>
							<img src='fonte/galeria/$verItemCapa[imgItem]' class='bd-placeholder-img card-img-center' width='100%' height='225' id='ip$verItemCapa[idItem]'>
						</a>
						<div class='card-body'>
							<p class='card-text'>$verItemCapa[textoItem]</p>
							<div class='d-flex justify-content-between align-items-center'>
								<div class='btn-group'>
									<form action='index.php?conteudo=banda&banda=$idBanda#ip$verItemCapa[idItem]' method='post'>
										<input type='hidden' name='conteudo' value='banda'>
										<input type='hidden' name='baixar' value='$verItemCapa[textoItem]'>
										<input type='hidden' name='iditem' value='$verItemCapa[idItem]'>
										<input type='hidden' name='idcapa' value='$verItemCapa[idCapaItem]'>";
										if(!isset($_POST['baixar']) or isset($_POST['baixar']) and $_POST['baixar'] != $verItemCapa["textoItem"]){
										echo "
										<button type='submit' class='btn btn-sm btn-outline-secondary'>Baixar</button>";
										}
										if(isset($_POST['baixar']) and $_POST['baixar'] == $verItemCapa["textoItem"]){
										//baixar
										//metodo de curtição da pagina inicial... capa e item
										$tbcurtiralbum = "insert into AlbumBaixar(idCurtirAlbum,imgCurtirAlbum,moduloCurtirAlbum,idCurtirItemAlbum,dataCurtirAlbum,horaCurtirAlbum,tempoCurtirAlbum) value(null,'$_POST[iditem]','baixadoImg','$_POST[idcapa]',NOW(),NOW(),NOW())";
										$analisarlikealbum = $certificado->bd->query($tbcurtiralbum) or die ($certificado->bd->error);
										if($analisarlikealbum == true){
										}
										echo "
										<a href='fonte/galeria/$verItemCapa[imgItem]' class='btn btn-sm btn-outline-primary' download>Agora</a>";
										
										}
										echo "
									</form>
									<form action='index.php?conteudo=curtir&hid=$verItemCapa[idItem]' method='post'>
										<input type='hidden' name='serrie' value='$idBanda'>
										<input type='hidden' name='conteudo' value='$verItemCapa[imgItem]'>
										<input type='hidden' name='curtir' value='$verItemCapa[idItem]'>
										<input type='hidden' name='modulo' value='item'>
										<button type='submit' class='btn btn-sm btn-outline-secondary'>Curtir</button>
									</form>";
									if(isset($_SESSION["usuario"]) and $_SESSION["usuario"] == $verCapa["usuarioAlbum"]){
									echo "
									<form action='index.php?conteudo=updateitem&hid=$idBanda' method='post'>
									<input type='hidden' value='$idBanda' class='dp-none' name='hid'>
									<input type='hidden' value='$verItemCapa[idItem]' class='dp-none' name='id'>
									<input type='hidden' value='$verItemCapa[imgItem]' class='dp-none' name='conteudo'>
									<input type='hidden' value='$verItemCapa[idUsuarioItem]' class='dp-none' name='idusuario'>
									<button type='submit' class='btn btn-sm btn-outline-primary' name='confirmar'>Editar</button>
									
									</form>
									";
									}
									echo "
								</div>
								<small class='text-muted'>$verItemCapa[dataItem]</small>
							</div>
						</div>
					</div>
				</div>";
				}
				echo "
				</div>
				</div>
				</div>
				";
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
				$tabelacurtir = "select * from AlbumCurtir where idCurtirItemAlbum = '$idBanda' and moduloCurtirAlbum = '$_GET[ver]'";
				$confirmarcurtir = $certificado->bd->query($tabelacurtir) or die($certificado->bd->error);
				$pegarcurtir = $confirmarcurtir->fetch_array();
				$totalcurtir = $confirmarcurtir->num_rows;
				echo "
				</div>
				<div class='d-flex row'>
					<div class='col-6'>
					Curtidas: $totalcurtir vezes
					</div>
					<div class='col-6'>
					unidade: $idBanda idCAPA
					</div>
				</div>
				";
				}else if($_GET["ver"] == "item"){
				//exibir item da capa caso o click for na imagem
				$pegartabelausuariologadoo = "select * from AlbumItens where idItem = '$idBanda' limit 1";
				$preparartbusuariologadoo = $certificado->bd->query($pegartabelausuariologadoo) or die ($certificado->bd->error);
				$verItem = $preparartbusuariologadoo->fetch_array();
				echo "
				<div class=''>";
				
				if(is_file("fonte/galeria/$verItem[imgItem]")){
				echo "<img src='fonte/galeria/$verItem[imgItem]' class='container-fluid' height='100%'>";
				}else{
				echo "<img src='fonte/img/logotipo.svg' class='bd-placeholder-img card-img-top' width='100%' height='100%'>";
				echo "</div>";
				}
				//pegar dados registado da capa ou seja conteudo inicial capa
				$tabelacurtir = "select * from AlbumCurtir where idCurtirItemAlbum = '$idBanda' and moduloCurtirAlbum = '$_GET[ver]'";
				$confirmarcurtir = $certificado->bd->query($tabelacurtir) or die($certificado->bd->error);
				$pegarcurtir = $confirmarcurtir->fetch_array();
				$totalcurtir = $confirmarcurtir->num_rows;
				//pegar dados de download realisado e mostrar a totalidade
				$tabelabaixar = "select * from AlbumBaixar where imgCurtirAlbum = '$_GET[banda]' and moduloCurtirAlbum= 'baixadoImg'";
				$confirmarbaixar = $certificado->bd->query($tabelabaixar) or die($certificado->bd->error);
				$pegarbaixar = $confirmarbaixar->fetch_array();
				$totalbaixar = $confirmarbaixar->num_rows;
				echo "
				</div>
				<hr><br>
				<div class='d-flex row'>
				<div class='col-6'>
				<b width='100%'>Curtidas: $totalcurtir Vezes</b><br>
				<b width='100%'>baixados: $totalbaixar download</b>
				</div>
				<div class='col-6'>
				unidade: $idBanda - itemCAPA
				</div>
				</div>
				";
				}
			}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "curtir" and isset($_POST["conteudo"]) and is_numeric($_GET["hid"]) and $_GET["hid"] >= 1){
				//curtir AlbumCapa, icone da serrie...
				if($certificado->tipo_de_site == "Banda Desenhada"){
					$idserrie = trim(strip_tags(filter_input(INPUT_POST,"serrie", FILTER_VALIDATE_INT)));
					$idcurtir = trim(strip_tags(filter_input(INPUT_POST,"curtir", FILTER_VALIDATE_INT)));
					$imgcurtir = trim(strip_tags(filter_input(INPUT_POST,"conteudo", FILTER_SANITIZE_STRING)));
					$modulocurtir = trim(strip_tags(filter_input(INPUT_POST,"modulo", FILTER_SANITIZE_STRING)));
					if(isset($_POST["modulo"])){
					//metodo de curtição da pagina inicial... capa e item
					$tbcurtiralbum = "insert into AlbumCurtir(idCurtirAlbum,imgCurtirAlbum,moduloCurtirAlbum,idCurtirItemAlbum,dataCurtirAlbum,horaCurtirAlbum,tempoCurtirAlbum) value(null,'$imgcurtir','$modulocurtir','$idcurtir',NOW(),NOW(),NOW())";
					$analisarlikealbum = $certificado->bd->query($tbcurtiralbum) or die ($certificado->bd->error);
					if($analisarlikealbum == true){
					if($_POST["modulo"] == "item"){
					header("location: index.php?conteudo=banda&banda=$idserrie#hid$idserrie");
					}else if($_POST["modulo"] == "capa"){
					header("location: index.php?banda=$idserrie#hid$idserrie");
					
					}
					}
					}
				//	echo "$modulo <hr> $idImg <hr> $idcurtir<hr>";
					
				 echo $_SERVER["SERVER_ADDR"];
				}else if($certificado->tipo_de_site == "Videos"){
				 
				}else if($certificado->tipo_de_site == "Musicas"){
				
				}else if($certificado->tipo_de_site == "Frases"){
				
				
				}
				
			}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "updateitem" and isset($_POST["conteudo"]) and is_numeric($_GET["hid"]) and $_GET["hid"] >= 1){
				///atualisar capa
				$pegarTb = "SELECT * FROM AlbumItens WHERE idItem = '$_POST[id]' and idCapaItem = '$_GET[hid]' and idUsuarioItem = '$_SESSION[usuario]' LIMIT 1";
				$confTb = $certificado->bd->query($pegarTb) or die($certificado->bd->error);
				$pegardados = $confTb->fetch_array();
				$totalPg = $confTb->num_rows;
				//exibir formulario para edição de capa na pagina inde
				echo "
				<main class='px-3'>
				<div class=' color-white btn bg-light justify-content-center' id=''>
				<div class='container'>
				<h4 class='text-4 color-info'>Atualizar Dados Do Item</h4><hr>
				<div class='grupo-mdm-3 m-c m-b' id=''>";
				if(isset($_POST["editar"])){
					//atualilasando dados de capa modo ultra make
					$erro[] = null;
					$titulo = trim(strip_tags(filter_input(INPUT_POST,"titulo", FILTER_SANITIZE_STRING)));
					if(is_file($_FILES["arquivo"]["name"]) and $_FILES["arquivo"]["name"] == true){
						if(isset($titulo) and strlen($titulo) >= 4 and strlen($titulo) < 100){
							//só pode cadastrar usuario não registado com o e-mail já existente...
							$pegartabelausuario = "select * from AlbumItens where textoItem = '$titulo' and idUsuarioItem = '$_SESSION[usuario]'";// where usuarioAlbum = '$_SESSION[usuario]'";
							$preparartbusuario = $certificado->bd->query($pegartabelausuario) or die ($certificado->bd->error);
							$analisarusuario = $preparartbusuario->fetch_array();
							if(!isset($analisarusuario["idItem"])){
								//analisar banco de dados para saber quantidade de conteudos existentes
								$nome = strtolower($_FILES["arquivo"]["name"]);
								$local = "fonte/galeria/";
								$peg = "select * from AlbumItens";// where usuarioAlbum = '$_SESSION[usuario]'";
								$prep = $certificado->bd->query($peg) or die ($certificado->bd->error);
								$totimg = $prep->num_rows;
								if($totimg == 1){
									//excluir imagens na galeria se sò existir uma no banco
									unlink("fonte/galeria/$_POST[conteudo]");
								}
								move_uploaded_file($_FILES["arquivo"]["tmp_name"],$local.$nome);
								//cadastrando usuario no banco de dados na tabela usuarioDc
								$tabelausuario = "update AlbumItens set imgItem = '$nome', textoItem = '$titulo' WHERE idItem = '$pegardados[idItem]' and idUsuarioItem = '$_SESSION[usuario]'";
								$analisarusuarios = $certificado->bd->query($tabelausuario) or die ($certificado->bd->error);
								if($analisarusuarios == true){
									echo "cadastrado com sucesso";
									//pegar dados do usuario no bd com base os dados do formulario
									//header("location: index.php?conteudo=banda&banda=$pegardados[idAlbum]");
								}
								
							}else{
								//exibir erro em caso da senha não for de acordo com as regras...
								$erro[] = "já existe o conteudo que tenta carregar! tente novamente...";
							}
							//fim preparar cadastro
			 			}else{
							//exibir erro em caso da senha não for de acordo com as regras...
							$erro[] = "Titulo da serrie invalido! tente novamente...";
						}
					}else if(!is_file($_FILES["arquivo"]["name"])){
						//atualizar itens sem precisar mudar o png ou imagem
						if(isset($titulo) and strlen($titulo) >= 4 and strlen($titulo) < 100){
							//só pode cadastrar usuario não registado com o e-mail já existente...
							$pegartabelausuario = "select * from AlbumItens where textoItem = '$titulo' and idUsuarioItem = '$_SESSION[usuario]'";// where usuarioAlbum = '$_SESSION[usuario]'";
							$preparartbusuario = $certificado->bd->query($pegartabelausuario) or die ($certificado->bd->error);
							$analisarusuario = $preparartbusuario->fetch_array();
							if(!isset($analisarusuario["idItem"])){
							//cadastrando usuario no banco de dados na tabela usuarioDc
							$tabelausuario = "update AlbumItens set textoItem = '$titulo' WHERE idItem = '$pegardados[idItem]' and idUsuarioItem = '$_SESSION[usuario]'";
							$analisarusuarios = $certificado->bd->query($tabelausuario) or die ($certificado->bd->error);
							if($analisarusuarios == true){
							echo "cadastrado com sucesso";
							//pegar dados do usuario no bd com base os dados do formulario
							//header("location: index.php?conteudo=banda&banda=$pegardados[idAlbum]");
							}
							}
							
						}
					}
						
						
						
						
						
					
					foreach($erro as $bugou){
						//exibir todos erros do formulario aqui via sequencia
						if(isset($_POST["confirmar"])){
							echo "<div class='' id=''>$bugou</div>";
						}
					
					}
				}
				echo "</div>
				<form action='index.php?conteudo=updateitem&hid=$_GET[hid]' method='post' enctype='multipart/form-data'>
				<div class='grupo-mdm-3 m-c m-b'>
				<label class='form-control'>Carregar Novo Item (opcional)</label>
				<input type='hidden' value='$pegardados[idItem]' class='dp-none' name='hid'>
				<input type='hidden' value='$_POST[id]' class='dp-none' name='id'>
				<input type='hidden' value='$pegardados[imgItem]' class='dp-none' name='conteudo'>
				<input type='hidden' value='$pegardados[idUsuarioItem]' class='dp-none' name='idusuario'>
				<input type='file' name='arquivo' class='form-control me-2' placeholder='Nome do usuario' id='nome'>
				</div><hr>
				<div class='grupo-mdm-3 m-c m-b'>
				<label class='form-control'>titulo do item</label>
				<textarea type='titulo' height='200' name='titulo' class='form-control me-2' id='exampleFormControlInput2' placeholder='ex: temporada 1 epsodio 1' required>$pegardados[textoItem]</textarea>
				</div>
				<div class='grupo-mdm-3 m-c m-b'>
				<input type='submit' value='confirmar item' class='form-control btn btn-outline-primary ' name='editar'>
				</div>
				</form>
				</div>
				</div>
				</main>
				";
				
			}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "updatecapa" and isset($_POST["conteudo"]) and is_numeric($_GET["hid"]) and $_GET["hid"] >= 1){
			///atualisar item de capa
			$pegarTb = "SELECT * FROM AlbumCapa WHERE idAlbum = '$_POST[hid]' and usuarioAlbum = '$_SESSION[usuario]' LIMIT 1";
			$confTb = $certificado->bd->query($pegarTb) or die($certificado->bd->error);
			$pegardados = $confTb->fetch_array();
			$totalPg = $confTb->num_rows;
			//exibir formulario para edição de capa na pagina inde
			echo "
			<main class='px-3'>
			<div class=' color-white btn bg-light justify-content-center' id=''>
			<div class='container'>
			<h4 class='text-4 color-info'>Atualizar Dados Da Capa</h4><hr>
			<div class='grupo-mdm-3 m-c m-b' id=''>";
			if(isset($_POST["editar"])){
			//atualilasando dados de capa modo ultra make
			$erro[] = null;
			$titulo = trim(strip_tags(filter_input(INPUT_POST,"titulo", FILTER_SANITIZE_STRING)));
			if(is_file($_FILES["arquivo"]["name"]) and $_FILES["arquivo"]["name"] == true){
			if(isset($titulo) and strlen($titulo) >= 4 and strlen($titulo) < 100){
			//só pode cadastrar usuario não registado com o e-mail já existente...
			$pegartabelausuario = "select * from AlbumCapa where textoAlbum = '$titulo' and usuarioAlbum = '$_SESSION[usuario]'";// where usuarioAlbum = '$_SESSION[usuario]'";
			$preparartbusuario = $certificado->bd->query($pegartabelausuario) or die ($certificado->bd->error);
			$analisarusuario = $preparartbusuario->fetch_array();
			if(!isset($analisarusuario["idAlbum"])){
			//analisar banco de dados para saber quantidade de conteudos existentes
			$nome = strtolower($_FILES["arquivo"]["name"]);
			$local = "fonte/galeria/";
			$peg = "select * from AlbumCapa";// where usuarioAlbum = '$_SESSION[usuario]'";
			$prep = $certificado->bd->query($peg) or die ($certificado->bd->error);
			$totimg = $preg->num_rows;
			if($totimg == 1){
			//excluir imagens na galeria se sò existir uma no banco
			unlink("fonte/galeria/$_POST[conteudo]");
			}
			move_uploaded_file($_FILES["arquivo"]["tmp_name"],$local.$nome);
			//cadastrando usuario no banco de dados na tabela usuarioDc
			$tabelausuario = "update AlbumCapa set imgAlbum = '$nome', textoAlbum = '$titulo' WHERE idAlbum = '$pegardados[idAlbum]' and usuarioAlbum = '$_SESSION[usuario]'";
			$analisarusuarios = $certificado->bd->query($tabelausuario) or die ($certificado->bd->error);
			if($analisarusuarios == true){
			echo "cadastrado com sucesso";
			//pegar dados do usuario no bd com base os dados do formulario
			header("location: index.php?conteudo=banda&banda=$pegardados[idAlbum]");
			}
			
			}else{
			//exibir erro em caso da senha não for de acordo com as regras...
			$erro[] = "já existe o conteudo que tenta carregar! tente novamente...";
			}
			//fim preparar cadastro
			}else{
			//exibir erro em caso da senha não for de acordo com as regras...
			$erro[] = "Titulo da serrie invalido! tente novamente...";
			}
			}else if(!is_file($_FILES["arquivo"]["name"]) and $_FILES["arquivo"]["name"] == false){
				//atualisar dados da capa sem precisar alterar o png ou imagem
				
				
				if(isset($titulo) and strlen($titulo) >= 4 and strlen($titulo) < 100){
				//só pode cadastrar usuario não registado com o e-mail já existente...
				$pegartabelausuario = "select * from AlbumCapa where textoAlbum = '$titulo' and usuarioAlbum = '$_SESSION[usuario]'";// where usuarioAlbum = '$_SESSION[usuario]'";
				$preparartbusuario = $certificado->bd->query($pegartabelausuario) or die ($certificado->bd->error);
				$analisarusuario = $preparartbusuario->fetch_array();
				if(!isset($analisarusuario["idAlbum"])){
				//cadastrando usuario no banco de dados na tabela usuarioDc
				$tabelausuario = "update AlbumCapa set textoAlbum = '$titulo' WHERE idAlbum = '$pegardados[idAlbum]' and usuarioAlbum = '$_SESSION[usuario]'";
				$analisarusuarios = $certificado->bd->query($tabelausuario) or die ($certificado->bd->error);
				if($analisarusuarios == true){
				echo "cadastrado com sucesso";
				//pegar dados do usuario no bd com base os dados do formulario
				//header("location: index.php?conteudo=banda&banda=$pegardados[idAlbum]");
				}
				
				}
				}
				
				
				
			}
			foreach($erro as $bugou){
			//exibir todos erros do formulario aqui via sequencia
			if(isset($_POST["confirmar"])){
			echo "<div class='' id=''>$bugou</div>";
			}
			
			}
			}
			echo "</div>
			<form action='index.php?conteudo=updatecapa&hid=$_GET[hid]' method='post' enctype='multipart/form-data'>
			<div class='grupo-mdm-3 m-c m-b'>
			<label class='form-control'>Carregar Nova Imagem (opcional)</label>
			<input type='hidden' value='$pegardados[idAlbum]' class='dp-none' name='hid'>
			<input type='hidden' value='$pegardados[imgAlbum]' class='dp-none' name='conteudo'>
			<input type='hidden' value='$pegardados[usuarioAlbum]' class='dp-none' name='idusuario'>
			<input type='file' name='arquivo' class='form-control me-2' placeholder='Nome do usuario' id='nome' value=";if(isset($_SESSION['arquivo'])){echo $_SESSION['arquivo'];} echo "required>
			</div><hr>
			<div class='grupo-mdm-3 m-c m-b'>
			<label class='form-control'>titulo do item</label>
			<textarea type='titulo' height='200' name='titulo' class='form-control me-2' id='exampleFormControlInput2' placeholder='ex: temporada 1 epsodio 1' required>$pegardados[textoAlbum]</textarea>
			</div>
			<div class='grupo-mdm-3 m-c m-b'>
			<input type='submit' value='confirmar dados' class='form-control btn btn-outline-primary ' name='editar'>
			</div>
			</form>
			</div>
			</div>
			</main>
			";
			
			}
			
		/*echo "</div>
		</div>
	</div>*/
	echo "
</section>
";
}if($certificado->tipo_de_site == "Musicas"){
	include_once("musicas.php");	
}
/*
if($certificado->tipo_de_site == "Videos"){
	include_once("musicas.php");
}if($certificado->tipo_de_site == "Red Social"){
	include_once("musicas.php");
}if($certificado->tipo_de_site == "Frases"){
	include_once("musicas.php");
}
*/
?>