<header>
  <!--Header-cabecalho-->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  	<div class="container-fluid">
  		<a class="navbar-brand" href="#">
  		<?php
  		if($certificado->nome_do_site == true){
  			echo "
  				$certificado->nome_do_site
  			";
  		}
  		?>
  		</a>
  		<button class="navbar-toggler bg-out-line-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
  			<span class="navbar-toggler-icon"></span>
  		</button>
  		<div class="collapse navbar-collapse" id="navbarCollapse">
  			<ul class="navbar-nav me-auto mb-2 mb-md-0">
  			<?php
  			if($certificado->mostrar_link_cabecalho == "Sim"){
  			echo "
  				<li class='nav-item active'>
  					<a class='nav-link' aria-current='page' href='index.php'>$certificado->link_1_titulo</a>
  				</li>
  				<li class='nav-item'>
  					<a class='nav-link' href='publicidade.php'>$certificado->link_2_titulo</a>
 				</li>";
 				if(isset($certificado->tipo_de_site) and $certificado->tipo_de_site != "Banda Desenhada" and $certificado->tipo_de_site != "Musicas" and $certificado->tipo_de_site != "Videos"){
 				
 				echo "
  				<li class='nav-item'>
  					<a class='nav-link disabled' href='contacto.php' tabindex='-1' aria-disabled='true'>$certificado->link_3_titulo</a>
  				</li>
 				<li class='nav-item'>
  					<a class='nav-link disabled' href='configuracao.php' tabindex='-1' aria-disabled='true'>$certificado->link_4_titulo</a>
  				</li>
  				<li class='nav-item'>
  					<a class='nav-link disabled' href='sobre.php' tabindex='-1' aria-disabled='true'>$certificado->link_5_titulo</a>
  				</li>";
  				}
  			}
  		if($certificado->mostrar_link_cabecalho == "Sim 1"){
  		echo "
  			<li class='nav-item active'>
  				<a class='nav-link' aria-current='page' href='index.php'>$certificado->link_1_titulo</a>
  			</li>
 		";
  		}
  		if($certificado->mostrar_link_cabecalho == "Sim 2"){
  		echo "
  		<li class='nav-item active'>
  			<a class='nav-link' aria-current='page' href='publicidade.php'>$certificado->link_2_titulo</a>
  		</li>
  		";
  		}
  		if($certificado->mostrar_link_cabecalho == "Sim 3"){
  		echo "
  		<li class='nav-item active'>
  			<a class='nav-link' aria-current='page' href='contacto.php'>$certificado->link_3_titulo</a>
  		</li>
  		";
  		}
  		if($certificado->mostrar_link_cabecalho == "Sim 4"){
  		echo "
  		<li class='nav-item active'>
  			<a class='nav-link' aria-current='page' href='configuracao.php'>$certificado->link_4_titulo</a>
  		</li>
  		";
  		}
  		if($certificado->mostrar_link_cabecalho == "Sim 5"){
  		echo "
		<li class='nav-item active'>
  			<a class='nav-link' aria-current='page' href='sobre.php'>$certificado->link_5_titulo</a>
  		</li>
 		";
  		}
  		//nivel 2 complementar links do menu em secuencia
  if($certificado->mostrar_link_cabecalho == "Sim 1 2"){
  echo "
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='index.php'>$certificado->link_1_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='publicidade.php'>$certificado->link_2_titulo</a>
  </li>
  
  ";
  }
  if($certificado->mostrar_link_cabecalho == "Sim 1 2 3" and  $certificado->tipo_de_site != "Banda Desenhada"){
  echo "
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='index.php'>$certificado->link_1_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='publicidade.php'>$certificado->link_2_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='contacto.php'>$certificado->link_3_titulo</a>
  </li>
  
  ";
  }
  if($certificado->mostrar_link_cabecalho == "Sim 1 2 3 4 " and  $certificado->tipo_de_site != "Banda Desenhada"){
  echo "
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='index.php'>$certificado->link_1_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='publicidade.php'>$certificado->link_2_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='contacto.php'>$certificado->link_3_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='configuracao.php'>$certificado->link_4_titulo</a>
  </li>
  
  ";
  }
  if($certificado->mostrar_link_cabecalho == "Sim 1 2 3 4 5" and  $certificado->tipo_de_site != "Banda Desenhada"){
  echo "
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='index.php'>$certificado->link_1_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='publicidade.php'>$certificado->link_2_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='contacto.php'>$certificado->link_3_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='configuracao.php'>$certificado->link_4_titulo</a>
  </li>
  <li class='nav-item active'>
  <a class='nav-link' aria-current='page' href='sobre.php'>$certificado->link_5_titulo</a>
  </li>
  
  ";
  }
   ?>
  </ul>
  <form class="d-flex" action="pesquisas.php" method="get">
  <?php
  if(isset($_SESSION["usuario"]) and $_SESSION["usuario"] >= 1 and is_numeric($_SESSION["usuario"])){
  echo "
  <a class='nav-link btn btn-outline-primary' aria-current='page' href='fecharconta.php'>sair</a>&nbsp;
  ";
  }else{
  echo "
  <a class='nav-link btn btn-outline-primary' aria-current='page' href='usuario.php?usuario=login'>entrar</a>&nbsp;
  ";
  }
  
  ?>
  <input class="form-control me-2" name="buscar" type="search" placeholder="pesquisar conteudos..." aria-label="Search">
  <button class="btn btn-outline-success" type="submit">buscar</button>
  </form>
  </div>
  </div>
  </nav>
  </header>