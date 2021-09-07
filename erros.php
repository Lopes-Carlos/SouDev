<?php
include_once("fonte/documentos/fbsuper.php");

if($erro_do_banco != "Sim"){
	echo "
	<html class='h-100'>
  		<body class='d-flex h-100 text-center text-white bg-dark'>
			<div class='cover-container d-flex w-100 h-100 p-3 mx-auto flex-column'>
  				<header class='mb-auto'>
  					<div>
      					<h3 class='float-md-start mb-0 text-4'>$nome_do_site</h3>
      					<nav class='nav nav-masthead justify-content-center float-md-end'>";
      						if(isset($_GET["erro"]) and $_GET["erro"] == "dicas"){
      						echo "
       						<a class='nav-link' aria-curruent='page' href='index.php'>Erro</a>
        					<a class='nav-link active' href='index.php?erro=dicas'>Dicas</a>
        					<a class='nav-link' href='index.php?erro=contacto'>Contacto</a>";
        					}else if(isset($_GET["erro"]) and $_GET["erro"] == "contacto"){
        					echo "
        					<a class='nav-link' aria-curruent='page' href='index.php'>Erro</a>
        					<a class='nav-link' href='index.php?erro=dicas'>Dicas</a>
        					<a class='nav-link active' href='index.php?erro=contacto'>Contacto</a>";
        					
        					}else{
        					echo "
        					<a class='nav-link active' aria-curruent='page' href='index.php'>Erro</a>
        					<a class='nav-link' href='index.php?erro=dicas'>Dicas</a>
        					<a class='nav-link' href='index.php?erro=contacto'>Contacto</a>";
        					
        					}
        					echo "
      					</nav>
    				</div>
  				</header>";
  				if(isset($_GET["erro"]) and $_GET["erro"] == "dicas"){
  				echo "
  				<main class='px-3'>
    				<h1 class='text-warning text-4'>Como Usar O Banco De Dados ?</h1>
    				<p class='lead'>
    					1 passo: verifica no diretorio admin se tem um arquivo .sql
  					</p>
    				<p class='lead'>
    				2 passo: execute o seu servidor e crie um banco de dados e nomea ele no construtor.txt do seu site
    				</p>
    				<p class='lead'>
    				3 passo: abra o seu banco de dados no phpmyadmin e importa o arquivo .sql do seu diretorio admin
    				</p>
    				<p class='lead text-info'>
    				Aviso: Apois importar o banco de dados você não vera mais este erro...
    				</p>
    				<br>
				</main>";
				}else if(isset($_GET["erro"]) and $_GET["erro"] == "contacto"){
				echo "
				<main class='px-3'>
				<h1 class='text-info text-5'>Informe-nos porque deste erro!</h1>
				<div class='lead form-group'>
					";?>
					
					<hr class="">
					
					<div class="">
					<form method="post" action="index.php?erro=contacto" class="needs-validation" novalidate>
					<div class="row g-3">
					<div class="col-sm-6">
					<label for="firstName" class="form-label">Nome Completo</label>
					<input type="text" class="form-control" id="firstName" placeholder="" value="" required>
					<div class="invalid-feedback">
					Valid first name is required.
					</div>
					</div>
					
					<div class="col-sm-6">
					<label for="lastName" class="form-label">Numero De Contacto</label>
					<input type="text" class="form-control" id="lastName" placeholder="" value="" required>
					<div class="invalid-feedback">
					Valid last name is required.
					</div>
					</div>
					
					<div class="col-12">
					<label for="username" class="form-label">Endereço De E-mail</label>
					<div class="input-group">
					<span class="input-group-text">@</span>
					<input type="email" class="form-control" id="username" placeholder="Username" required>
					<div class="invalid-feedback">
					Your username is required.
					</div>
					</div>
					</div>
					
					<div class="col-12">
					<label for="email" class="form-label">Descrição do problema <span class="text-muted">?</span></label>
					<input type="text" class="form-control" id="email" placeholder="you@example.com">
					<div class="invalid-feedback">
					Please enter a valid email address for shipping updates.
					</div>
					</div>
					
					
					<hr class="">
				
					<button class="w-100 btn btn-primary btn-lg" type="submit">Solicitar ajuda</button>
					</form>
					</div>
					<hr class="">
					
					<h4 class="txt-5">podes verificar tambem no seu g-mail se há respostas</h4>
					
					
					
					</div>
					
					
					
					<?php echo "
					
				</div>
				</main>";
				}else{
				echo "
				<main class='px-3'>
				<h1 class='text-danger text-4'>Banco De Dados Indisponivél</h1>
				<p class='lead'>
				Se voçê esta vendo esta tela é porque o seu site não esta conectado ao banco de dados. click em dicas e siga o tutorial
				</p>
				<p class='lead'>
				<b href='#' class='btn btn-lg btn-secondary fw-bold border-white bg-white'>Error: $nome_bd_conectar</b>
				</p>
				</main>";
				}
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