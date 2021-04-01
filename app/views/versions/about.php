<?php require APPROOT . '/views/inc/header.php'?>
<div class="col-md-12 mx-auto">
	<div class="jumbotron jumbotron-flud">
		<div class="container">
			<h1 class="display-3"><?php echo $data['title']; ?></h1>
			<p class="lead">Version <?php echo APPVERSION; ?></p>
			<p class="lead">Implementación parcial de la api rest 
			<a target="blank" href="https://www.cisco.com/c/es_mx/support/docs/conferencing/meeting-server/213812-cisco-meeting-server-basic-api-functions.pdf">Cisco CMS</a></p>
			<p class="lead">Para una descripción de las funcionalidades implementadas visite  
			<a target="blank" href="#">Ayuda</a></p>
		</div>
	</div>
</div>	
<?php require APPROOT . '/views/versions/inc/footer.php' ?>
