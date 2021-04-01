<?php require APPROOT . '/views/inc/header.php'?>
	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card card-body bg-light mt-5">
				<h2>Login</h2>
				<p>Please, fill out this form to register with us</p>
				<form action="<?php echo URLROOT;?>/users/login" method="post">
					<div class="form-group">
						<label for="user">email: <sup>*</sup></label>
						<input type="user" name="user" class="form-control form-control-lg 
						<?php echo (!empty($data['user_err'])) ? 'is-invalid':'';?>" 
						      value="<?php echo $data['user'];?>">
						<span class="invalid-feedback"><?php echo $data['user_err'];?></span>
					</div>
					<div class="form-group">
						<label for="password">Password: <sup>*</sup></label>
						<input type="password" name="password" class="form-control form-control-lg 
						<?php echo (!empty($data['password_err'])) ? 'is-invalid':'';?>" 
						      value="<?php echo $data['password'];?>">
						<span class="invalid-feedback"><?php echo $data['password_err'];?></span>
					</div>
					<div class="row">
						<div class="col">
							<input type="submit" value="Login" class="btn btn-success btn-block">
						</div>
					</div> 
				</form>
			</div>
		</div>
	</div>
<?php require APPROOT . '/views/inc/footer.php' ?>
