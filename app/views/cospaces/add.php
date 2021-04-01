<?php require APPROOT . '/views/inc/header.php'?>

<div class="col-md-6 mx-auto">
	<a href="<?php echo URLROOT . "/cospaces/index"?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
	
	<div class="card card-body bg-light mt-5">
		
		<h2>Add coSpace</h2>
		<p>Fill out this form to create a new cospace</p>
		
		<form action="<?php echo URLROOT;?>/cospaces/add" method="post">
			
			<div class="form-group">
				<label for="title">Title<sup>*</sup></label>
				<input type="text" name="title" class="form-control form-control-lg 
				<?php echo (!empty($data['title_err'])) ? 'is-invalid':'';?>" 
				      value="<?php echo $data['title'];?>" required="true">
				<span class="invalid-feedback"><?php echo $data['title_err'];?></span>
			</div>
			
			<div class="form-group ">
				<label for="usuario">Usuario<sup>*</sup></label>
				<select class="form-control form-control-lg" id="usuario" name="usuario" 
				        required="true" <?php echo (!empty($data['title_err'])) ? 'is-invalid':'';?>>
					<option value="">Seleccione:</option>
					<?php
						foreach ($data['usuario'] as $user):
							echo '<option value="'. $user->id . '">'.$user->userjid.'</option>';
						endforeach;
					?>
				</select>
				<span class="invalid-feedback"><?php echo $data['usuario_err'];?></span>
			</div>
			<div class="form-group ">
				<label for="date"> Fecha<sup>*</sup></label>
				<div class="input-group">
					<input class="form-control" id="fecha" name="fecha" placeholder="DD/MM/AAAA" type="text" required="true"/>
				</div>
			</div>
			<div class="form-group ">
				<label for="hora">Hora<sup>*</sup></label>
				<input type="time" id="hora" name="hora" min="00:00" max="23:59" required="true">
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input type="submit" class="btn btn-success" value="submit">
				</div>
			</div>
			
		</form>
	</div>
</div>

<?php require APPROOT . '/views/inc/footer.php' ?>

