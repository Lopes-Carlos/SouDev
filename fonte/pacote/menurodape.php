<?php
include_once("fonte/documentos/certificado.php");

echo "
<div class='bg-dark fixed-bottom container-fluid text-white'>
	";
	if($certificado->rdp_ver_detalhes == "Sim"){
	echo "
	<div class='d-flex justify-content-center'>
		<div class='col'>
			<p class='text-primary'>
				<p class=''>$this->rdp_4_titulo</p>
			</p>
			<p class=''>
				<p class=''>$this->rdp_5_titulo</p>
			</p>
		</div>
		<div class='col d-flex justify-content-end'>
			<img src='fonte/img/$this->icone_do_site' class='row col-6'>
		</div>
	</div>";
	}
	if($certificado->rdp_ver_detalhes == "Opção"){
	echo "
	<div id='detalhes' class='d-flex p justify-content-center' id='detalhes'>^</div>
	<div id='basedetalhes' class=''>
	<div class='d-flex justify-content-center'>
		<div class='col'>
			<p class='text-primary'>
				<p class=''>$certificado->rdp_4_titulo</p>
			</p>
			<p class=''>
				<p class=''>$certificado->rdp_5_titulo</p>
			</p>
		</div>
		<div class='col d-flex justify-content-end'>
			<img src='fonte/img/$certificado->icone_do_site' class='row col-6'>
		</div>
		</div>
	</div>";
	}
	echo "
	<div class='col d-flex text-secondary justify-content-center'>
		$certificado->rdp_1_titulo <a href='$certificado->rdp_3_titulo' target='_blank'>&nbsp;$certificado->rdp_2_titulo</a>
	</div>
	
</div>
";
?>