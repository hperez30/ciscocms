<?php require APPROOT . '/views/inc/header.php'?>

<div class="col-md-6 mx-auto">
	<a href="<?php echo URLROOT . "/cospaces"?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
	<div class="card card-body bg-light mt-5">
		<h1><?php echo $data['response']->name; ?></h1>
	</div>
	<form>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="URI">URI</label>
		  <input type="text" class="form-control" id="URI" value="<?php echo $data['response']->uri?>" readonly="true">
		</div>
		<div class="form-group col-md-6">
		  <label for="CallId">CallId</label>
		  <input type="text" class="form-control" id="CallId" value="<?php echo $data['response']->callid?>" readonly="true">
		</div>
	  </div>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="secret">Secret</label>
		  <input type="secret" class="form-control" id="secret" value="<?php echo $data['response']->secret?>" readonly="true">
		</div>
		<div class="form-group col-md-6">
		  <label for="passcode">Passcode</label>
		  <input type="text" class="form-control" id="passcode" value="<?php echo $data['response']->passcode?>" readonly="true">
		</div>
	  </div>
	  <div class="form-group">
		<label for="ownejid">ownerJid</label>
		<input type="text" class="form-control" id="ownejid" value="<?php echo $data['response']->ownejid?>" readonly="true">
	  </div>
	  <div class="form-group">
		<label for="ownerid">ownerId</label>
		<input type="text" class="form-control" id="ownerid" value="<?php echo $data['response']->ownerid?>" readonly="true">
	  </div>
	  
	</form>
	<hr>
	<!--<a href="<?php echo URLROOT; ?>/meetings/edit/<?php echo $data['id']?>" class="btn btn-dark">Edit</a>-->
	<form class="pull-right" action="<?php echo URLROOT; ?>/cospaces/delete/<?php echo $data['id']?>" method="post">
		<input type="submit" value="Delete" class="btn btn-danger">
	</form>
</div>
<?php require APPROOT . '/views/inc/footer.php' ?>

