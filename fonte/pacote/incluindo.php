<?php

include_once("fonte/documentos/certificado.php");

if(isset($_GET["entrar"]) and $_GET["entrar"] == "cadastro" and isset($_SESSION["usuario"]) and $_SESSION["usuario"] >= 1){
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
							$tabelausuario = "insert into AlbumCapa(idAlbum,imgAlbum,textoAlbum,usuarioAlbum,horaAlbum,dataAlbum,tempoAlbum) value(null,'$nome','$titulo','$_SESSION[usuario]',NOW(),NOW(),NOW())";
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
	
}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "itemupload" and is_numeric($_GET["hid"]) and $_GET["hid"] >= 1){
				//inserir item de cada capa ou seja conteudos
				$erro[] = null;
				if(isset($_FILES["arquivo"]["name"]) and $_FILES["arquivo"]["name"] == true){
				$titulo = trim(strip_tags(filter_input(INPUT_POST,"titulo", FILTER_SANITIZE_STRING)));
				if(isset($titulo) and strlen($titulo) >= 4 and strlen($titulo) < 100){
				//só pode cadastrar usuario não registado com o e-mail já existente...
				$pegartabelausuario = "select * from AlbumItens where textoItem = '$titulo'";// where usuarioAlbum = '$_SESSION[usuario]'";
				$preparartbusuario = $certificado->bd->query($pegartabelausuario) or die ($certificado->bd->error);
				$analisarusuario = $preparartbusuario->fetch_array();
				if(!isset($analisarusuario["idItem"])){
				//
				$nome = strtolower($_FILES["arquivo"]["name"]);
				$local = "fonte/galeria/";
				move_uploaded_file($_FILES["arquivo"]["tmp_name"],$local.$nome);
				//cadastrando usuario no banco de dados na tabela usuarioDc
				$tabelausuario = "insert into AlbumItens(idItem,imgItem,textoItem,idCapaItem,idUsuarioItem,horaItem,dataItem,tempoItem) value(null,'$nome','$titulo','$_GET[hid]','$_SESSION[usuario]',NOW(),NOW(),NOW())";
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
				/*
				$hi = "
				<div class='grupo m-c m-b' id=''>
				<h4 class='ttl3 cv'>Carregar nova serrie</h4><hr>
				<div class='grupo-mdm-3 m-c m-b' id=''>
				</div>
				<form action='index.php?entrar=cadastro&conteudo=upload&banda=$_GET[banda]' method='post' enctype='multipart/form-data'>
				<div class='grupo-mdm-3 m-c m-b'>
				<label class='ttl3 ca'>Imagem de capa</label>
				<input type='file' name='arquivo' class='inpt-txt' placeholder='Nome do usuario' id='nome' value=''required>
				</div><hr>
				<div class='grupo-mdm-3 m-c m-b'>
				<label class='ttl3 ca'>titulo do conteudo</label>
				<input type='titulo' name='titulo' class='inpt-txt' id='exampleFormControlInput2' placeholder='ex: temporada 1 epsodio 1' value=''required>
				</div>
				<div class='grupo-mdm-3 m-c m-b'>
				<input type='submit' value='confirmar' class='inpt-enviar' name='confirmar'>
				</div>
				</form>
				</div>";
				*/
				
	}else if(isset($_GET["registrar"]) and $_GET["registrar"] == "usuario"){
		echo "registrando usuario";
		if (isset($_POST['confirmar'])) {
		
		foreach ($_POST as $chave=>$valor)
		$_SESSION[$chave] = $certificado->bd->real_escape_string(htmlspecialchars(strip_tags(filter_input(INPUT_POST,'$valor',FILTER_SANITIZE_STRING))));
		
		if (strlen($_POST['nome']) < 6 || strlen($_POST['nome'] > 8 || $_POST['nome'] == '' || $_POST['nome'] == false))
		$erro[] = "Nome não aprovado. <span></span>";
		if (substr_count($_POST['email'], '@') != 1 || substr_count($_POST['email'], '.') < 1 || substr_count($_POST['email'], '.') > 4)
		$erro[] = "E-mail não aprovado!<span></span>";
		if (!is_numeric($_POST['numero']))
		$erro[] = "Número não aprovado. <span></span>";
		if (strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 16)
		$erro[] = "A senha deve conter entre 8 a 16 caracteres!";
		if (strcmp($_POST['senha'], $_POST['rsenha']) != 0)
		$erro[] = "confirmação de senha diferente!";
		//verificar dados e iciar sistema
		if (!isset($erro)) {
		$nome = "$_POST[nome]";
		$senha = md5($_POST['senha']);
		if(preg_match("/^[a-zA-Z ]*$/",$nome) && $nome != "'or''='" && $nome != null){
		$sql_code = "INSERT INTO usuarioscad(id, nomecad, emailcad,numerocad, senhacad,datacad, horacad, tempocad) VALUES(null,'$nome','$_POST[email]','$_POST[numero]','$senha',NOW(),NOW(),NOW())";
		$confirma = $certificado->bd->query($sql_code) or die ($certificado->bd->error);
		if ($confirma) {
		$pegar = "SELECT id FROM usuarioscad WHERE emailcad = '$_POST[email]' and senhacad = '$senha' LIMIT 1";
		$verificar = $certificado->bd->query($pegar) or die ($certificado->bd->error);
		$dado = $verificar->fetch_assoc();
		$_SESSION['usuario'] = "$dado[id]";
		unset($_SESSION['nome'],$_SESSION['email'],$_POST['sexo'],$_POST['senha']);
		setcookie("user",$_SESSION["usuario"],time()+3600*24*7,"www");
		header("location: index.php?aviso=access");
		}else {
		$erro[] = $confirma;
		}
		}}
		if (isset($erro)) {
		$_SESSION['nome'] = $_POST['nome'];
		$_SESSION['email'] = $_POST['email'];
		echo "<h4 class='cp txt3'></h4>";
		foreach($erro as $aviso)
		echo "<div class='bp ttl4 p'>
		<p class='ttl3 cv'>$aviso</p><hr>
		</div>";
		}
		echo "<hr><br>";
		}
		
	}else if(isset($_GET["usuario"]) and $_GET["usuario"] == "login"){
	//iniciar sessão...
	if(isset($_POST['cmtlogin'])) {
	$emailfb = trim(htmlspecialchars(strip_tags(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))));
	$senha = trim(htmlspecialchars(strip_tags(filter_input(INPUT_POST,'senha',FILTER_SANITIZE_SPECIAL_CHARS))));
	$senhafb = md5(preg_replace('/[^[:alpha:]_]/','',$senha));
	if(substr_count($emailfb, '@') == 1 and substr_count($emailfb,'.') >= 1 and substr_count($emailfb,'.') < 3) {
	if(isset($senha) and strlen($senha) >= 6 and strlen($senha) <= 16){
	$tabelauser = "select nomecad, senhacad, emailcad, id from usuarioscad where emailcad = '$emailfb' limit 1";
	$conftabelauser = $certificado->bd->query($tabelauser) or die($mysqli->error);
	$veruser = $conftabelauser->fetch_assoc();
	if($emailfb != $veruser["emailcad"]){
	echo "<p class='cv ttl3'>E-mail inválido!</p>";
	}else if($senhafb != $veruser["senhacad"]){
	echo "<p class='cv ttl3'>Senha inválida!<p/>";
	}else if($emailfb == $veruser["emailcad"] and $senhafb == $veruser["senhacad"]){
	$tabelause = "select nomecad, senhacad, emailcad, id from usuarioscad where emailcad = '$emailfb' and senhacad = '$senhafb' limit 1";
	$conftabelause = $certificado->bd->query($tabelause) or die($mysqli->error);
	$veruse = $conftabelause->fetch_assoc();
	if($veruse == true){
	echo "<p class='ca ttl3'>sessão iniciada com sucesso!</>";
	$_SESSION["usuario"] = $veruse["id"];
	setcookie("user",$_SESSION["usuario"],time()+3600*24*7,"www");
	header("location: publicidade.php");
	}
	}
	
	}else {
	echo "<p class='cv ttl3'>Erro na digitação da senha!<p/>";
	}
	}else {
	echo "<p class='cv ttl3'>Erro na digitação do e-mail!</p>";
	}
	}
	}
	?>
	