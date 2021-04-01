<?php require APPROOT . '/views/inc/header.php'?>

<div class="col-md-6 mx-auto">
	<a href="<?php echo URLROOT . "/cmsusers"?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
	<div class="card card-body bg-light mt-5">
		<h1><?php echo $data['response']->userjid; ?></h1>
	</div>
	<div>
		<p><strong>Id:</strong> <?php echo $data['response']->id; ?></p>
	</div>
	<hr>
	
</div>
<?php require APPROOT . '/views/inc/footer.php' ?>


