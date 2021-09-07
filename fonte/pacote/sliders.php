<section class="container-fluid">
		
		<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
		<ol class="carousel-indicators">
		<li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
		<li data-bs-target="#myCarousel" data-bs-slide-to="1"><./li>
		<li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
		<div class="carousel-item active">
		<?php
		echo "
		<img src='fonte/img/$certificado->fundo_slider_corpo' class='container-fluid'>
		";
		?>
		<div class="container">
		<div class="carousel-caption text-start d-none d-tb-block">
		<?php
		echo "
		<h1>$certificado->titulo_slider_corpo</h1>
		";
		?>
		<?php
		echo "
		<p>$certificado->texto_slider_corpo</p>
		";
		?><p><a class="btn btn-lg btn-primary" href="incluindo.php?entrar=cadastro" role="button"><?php
		echo "
		$certificado->button_slider_corpo
		";
		?></a></p>
		</div>
		</div>
		</div>
		<div class="carousel-item">
		<img src='fonte/img/fotob.png' class='container-fluid'>
		
		</div>
		<div class="carousel-item">
		<img src='fonte/img/fotoc.png' class='container-fluid'>
		
		<div class="container">
		<div class="carousel-caption text-end">
		</div>
		</div>
		</div>
		</div>
		<a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
		</a>
		<a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
		</a>
		</div>
		<br>
		
		
		<!-- Marketing messaging and featurettes
		================================================== -->
		<!-- Wrap the rest of the page in another container to center all the content. -->
		
		
		
		</section>