<?php
if($certificado->tipo_de_site == "Banda Desenhada"){

if(!isset($_GET["conteudo"])){
?>

<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 fw-normal">Album Capa</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">post <small class="text-muted">Atualizado</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Divulgue seus albuns</li>
          <li>compartilhe com amigos</li>
          <li>ganhe elogios pelo album</li>
          <li>não perca mais tempo</li>
        </ul>
        <?php
        if(isset($_SESSION["usuario"]) and strlen($_SESSION["usuario"]) >= 1){
        echo "
        <a class='w-100 btn btn-lg btn-outline-primary' href='publicidade.php?conteudo=upload' role='button'>postar e atualizar</a>
        ";
        }else{
        echo "
        <button type='button' class='w-100 btn btn-lg btn-secondary'>Carregar Album</button>
        ";
        }
        ?>
        </div>
    </div>
    </div>
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 fw-normal">Itens Album</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">post <small class="text-muted">/ mais itens</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Divulgue seus itens</li>
          <li>compartilhe com o mundo</li>
          <li>ganhe elogios pelos conteudos</li>
          <li>saiba quantos baixaram</li>
        </ul>
        <?php
        if(isset($_SESSION["usuario"]) and strlen($_SESSION["usuario"]) >= 1){
        	echo "
        	<a class='w-100 btn btn-lg btn-outline-primary' href='publicidade.php?conteudo=itens' role='button'>carregar itens</a>
        	";
        }else{
        	echo "
        	<button type='button' class='w-100 btn btn-lg btn-secondary'>Atualisar itens</button>
        	";
        }
        ?>
      </div>
    </div>
    </div>
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 fw-normal">compactado</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">post <small class="text-muted">/ zip & rar</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Divulgue seu pacote zip</li>
          <li>compartilhe com todos</li>
          <li>ganhe elogios pelo pacote</li>
          <li>saiba a quantidade de download</li>
        </ul>
        <button type="button" class="w-100 btn btn-lg btn-secondary">compartilhe arquivo</button>
      </div>
    </div>
    </div>
  </div>
  	<main class="container_fluid">
  	 	
  	
  	<div class="my-3 p-3 bg-white rounded shadow-sm">
  	<h6 class="border-bottom pb-2 mb-0">Notificações</h6>
  	<?php
  	//pegar elogios
  	$curtiu = "select sum(idCurtirItemAlbum), idCurtirItemAlbum from AlbumCurtir where moduloCurtirAlbum = 'capa' group by idCurtirItemAlbum order by sum(idCurtirItemAlbum) desc limit 3";
  	//$curtiu = "SELECT * FROM AlbumCapa order by idAlbum desc limit 3";
  	$cfCurtir = $certificado->bd->query($curtiu) or die ($certificado->bd->error);
  	$totlike = $cfCurtir->num_rows;
  	//pegar dados do album
  	 while($pegarAlbum = $cfCurtir->fetch_array()){
  	 	
  	 	//pegar dados do like
  	 	$som = "select * from AlbumCapa where idAlbum = '$pegarAlbum[idCurtirItemAlbum]' ";
  	 	//$curtiu = "SELECT * FROM AlbumCapa order by idAlbum desc limit 3";
  	 	$cfSom = $certificado->bd->query($som) or die ($certificado->bd->error);
  	 	$totSom = $cfSom->num_rows;
  	 	$pegarSom = $cfSom->fetch_array();
  	 	
  	 	$itens = "select * from AlbumItens where idCapaItem = '$pegarAlbum[idCurtirItemAlbum]'";
  	 	//$curtiu = "SELECT * FROM AlbumCapa order by idAlbum desc limit 3";
  	 	$cfItens = $certificado->bd->query($itens) or die ($certificado->bd->error);
  	 	$totitem = $cfItens->num_rows;
  	 	$verItens = $cfItens->fetch_assoc();
  	 	
  	 	
  	 	$curtir = "select * from AlbumCurtir where idCurtirItemAlbum = '$pegarAlbum[idCurtirItemAlbum]'";
  	 	//$curtiu = "SELECT * FROM AlbumCapa order by idAlbum desc limit 3";
  	 	$cfcurtir = $certificado->bd->query($curtir) or die ($certificado->bd->error);
  	 	$totcurtir = $cfcurtir->num_rows;
  	 	$verElogio = $cfcurtir->fetch_assoc();
  	 	
  	 	$pegarUsu = "SELECT * FROM usuarioscad WHERE id = '$pegarSom[usuarioAlbum]'";
  	 	$verificarUsu = $certificado->bd->query($pegarUsu) or die ($certificado->bd->error);
  	 	$dadoUsu = $verificarUsu->fetch_assoc();
  	 	
  	 	
  	echo "
  	<div class='d-flex text-muted pt-3'>
  	<svg class='bd-placeholder-img flex-shrink-0 me-2 rounded' width='32' height='32' xmlns='http://www.w3.org/2000/svg' role='img' aria-label='Placeholder: 32x32' preserveAspectRatio='xMidYMid slice' focusable='false'><title>Placeholder</title><rect width='100%' height='100%' fill='#007bff'/><text x='50%' y='50%' fill='#007bff'0 dy='.3em'>32x32</text></svg>
  	
  	
  	<p class='pb-3 mb-0 small lh-sm border-bottom'>
  	<strong class='d-block text-dark b'>$pegarSom[textoAlbum]</strong>
  	Alcansou $totcurtir elogios e esta na lista dos melhores conteudos mais elogiado. &nbsp; Atè agora possui $totitem itens disponivéis. &nbsp; Divulgado por $dadoUsu[nomecad]</p>
  	</div>";
  	}
  	?>
  	<small class='d-block text-end mt-3'>
  	<b class='text-danger '>Bloqueado</b>
  	</small>
  	</div>
  	
  	<div class="my-3 p-3 bg-white rounded shadow-sm">
  	<h6 class="border-bottom pb-2 mb-0">Contador Da Fama</h6>
  	<div class="d-flex text-muted pt-3">
  	<svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
  	
  	<div class="pb-3 mb-0 small lh-sm border-bottom w-100">
  	<div class="d-flex justify-content-between">
  	<strong class="text-gray-dark">Sem Conteudo</strong>
  	<a href="#">Indisponivél</a>
  	</div>
  	<span class="d-block">nenhum conteudo disponivél</span>
  	</div>
  	</div>
  	</main>

<?php
}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "upload"){
	include_once("pacote.php");
}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "itens"){
	include_once("pacote.php");
}else if(isset($_GET["conteudo"]) and $_GET["conteudo"] == "itemupload"){
	include_once("pacote.php");
}
}else{

}

?>