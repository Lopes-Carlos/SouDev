<?php

include_once("fonte/documentos/certificado.php");

if(isset($_GET["entrar"]) and $_GET["entrar"] == "cadastro"){// and isset($_SESSION["usuario"]) and $_SESSION["usuario"] >= 1){
	include_once("fonte/documentos/fbsuper.php");
	//preparar cdastro de usiartio
	$erro[] = null;
	if(isset($_FILES["arquivo"]["name"]) and $_FILES["arquivo"]["name"] == true){
		$titulo = trim(strip_tags(filter_input(INPUT_POST,"titulo", FILTER_SANITIZE_STRING)));
		if(isset($titulo) and strlen($titulo) >= 4 and strlen($titulo) < 100){
						//só pode cadastrar usuario não registado com o e-mail já existente...
						$pegartabelausuario = "select * from AlbumCapa where textoAlbum = '$titulo'";// where usuarioAlbum = '$_SESSION[usuario]'";
						$preparartbusuario = $certificado->bd->query($pegartabelausuario) or die ($certificado->bd->error);
						$analisarusuario = $preparartbusuario->fetch_array();
						if(!isset($analisarusuario["idAlbum"])){
						//
						$nome = strtolower($_FILES["arquivo"]["name"]);
						$local = "fonte/galeria/";
						move_uploaded_file($_FILES["arquivo"]["tmp_name"],$local.$nome);
							//cadastrando usuario no banco de dados na tabela usuarioDc
							$tabelausuario = "insert into AlbumCapa(idAlbum,imgAlbum,textoAlbum,usuarioAlbum,horaAlbum,dataAlbum,tempoAlbum) value(null,'$nome','$titulo','12345',NOW(),NOW(),NOW())";
							$analisarusuarios = $certificado->bd->query($tabelausuario) or die ($certificado->bd->error);
							if($analisarusuarios == true){
								echo "cadastrado com sucesso";
								//pegar dados do usuario no bd com base os dados do formulario
								
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
				}
	foreach($erro as $bugou){
		//exibir todos erros do formulario aqui via sequencia
		if(isset($_POST["confirmar"])){
			echo "<div class='' id=''>$bugou</div>";
		}
	}
	if(isset($_SESSION["usuario"])){
		//banir usuario desta tela se já estiver logado
		header("location: index.php");
	}
	?>
	<div class='grupo m-c m-b' id=''>
    	<h4 class='ttl3 cv'>Carregar nova serrie</h4><hr>
     	<div class='grupo-mdm-3 m-c m-b' id=''>
	</div>
	<form action="incluindo.php?entrar=cadastro" method="post" enctype='multipart/form-data'>
    	<div class='grupo-mdm-3 m-c m-b'>
       		<label class='ttl3 ca'>Imagem de capa</label>
        	<input type="file" name="arquivo" class='inpt-txt' placeholder="Nome do usuario" id="nome" value="<?php if(isset($_SESSION['arquivo'])){echo $_SESSION['arquivo'];}?>"required>
         </div><hr>
         <div class="grupo-mdm-3 m-c m-b">
         	<label class='ttl3 ca'>titulo do conteudo</label>
            <input type="titulo" name="titulo" class='inpt-txt' id="exampleFormControlInput2" placeholder="ex: temporada 1 epsodio 1" value="<?php if(isset($_SESSION['titulo'])){echo $_SESSION['titulo'];}?>"required>
         </div>
         <div class='grupo-mdm-3 m-c m-b'>
			<input type="submit" value='confirmar' class='inpt-enviar' name="confirmar">
         </div>
       </form>
  	</div>
  <?php } ?>