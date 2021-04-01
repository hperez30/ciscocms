<?php require APPROOT . '/views/cmsusers/inc/header.php'?>
<div class="col-md-10 mx-auto">
	
	<div class="container">
		<h3 class="display-3"><?php echo $data['title']; ?></h3>
		<p><?php echo $data['description']; ?></p>
	</div>

	<?php flash('cospace_message'); ?>
	<table id="product-list" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
          <th scope="col">Id</th>
		  <th scope="col">UserJid</th>
		  <th class="text-center"> Acciones </th> 
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>  
</div>
<?php require APPROOT . '/views/cmsusers/inc/footer.php' ?>
