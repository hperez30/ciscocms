<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo URLROOT;?>/cospaces/index"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsDefault">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
		<?php if(isset($_SESSION['user_name'])): ?>  
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT;?>/versions/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo URLROOT;?>/cospaces/index">coSpaces</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo URLROOT;?>/cmsusers/index">CMS usuarios</a>
        </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ml-auto">
		<?php if(isset($_SESSION['user_name'])): ?>
		<li class="nav-item">
          <a class="nav-link" aria-current="page"> Usuario <?php echo $_SESSION['user_name'];?></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo URLROOT;?>/users/logout">Logout</a>
        </li>
        <?php else: ?>  
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo URLROOT;?>/users/login">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


