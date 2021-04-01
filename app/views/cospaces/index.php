<?php require APPROOT . '/views/cospaces/inc/header.php'?>
<div class="col-md-10 mx-auto">
	
	<div class="container">
		<p> <h3 class="display-3"><?php echo $data['title']; ?></h3> <?php echo $data['description']; ?></p>
	</div>
	<?php flash('cospace_message'); ?>
	<table id="product-list" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
          <th scope="col">Id</th>
		  <th scope="col">Nombre</th>
		  <th scope="col">URI</th>
		  <th class="text-center"> Acciones </th> 
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>  
  <a href="<?php echo URLROOT . "/cospaces/add"?>" class="btn btn-light"><i class="fa fa-plus"></i> Add coSpace</a>
</div>
<?php require APPROOT . '/views/cospaces/inc/footer.php' ?>
