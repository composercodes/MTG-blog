  <div class="row">
	<div class="col-12">
	  <span class="d-flex align-items-center purchase-popup">
		<p>Welcome, <?=  $this->session->read('Auth.User.username')?> &nbsp</p>
		<a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'view',$this->session->read('Auth.User.id'))); ?>"  class="btn purchase-button">My Profile</a>
		<a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'edit',$this->session->read('Auth.User.id'))); ?>"  class="btn purchase-button">Edit Profile Information</a>	
		<a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'reset',$this->session->read('Auth.User.id'))); ?>"  class="btn purchase-button">Reset  Password</a>			
		
	  </span>
	</div>
  </div>
  <div class="page-header">
	<h3 class="page-title">
	  <span class="page-title-icon bg-gradient-primary text-white mr-2">
		<i class="mdi mdi-home"></i>                 
	  </span>
	  Dashboard
	</h3>
	<nav aria-label="breadcrumb">
	  <ul class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">
		  <span></span>Overview
		  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
		</li>
	  </ul>
	</nav>
  </div>
  <div class="row">
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-danger card-img-holder text-white">
		<div class="card-body">
	
		  <h4 class="font-weight-normal mb-3">Posts
			<i class="mdi mdi-chart-line mdi-24px float-right"></i>
		  </h4>
		  <h2 class="mb-5"><?= $posts ?></h2>
		
		</div>
	  </div>
	</div>
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-info card-img-holder text-white">
		<div class="card-body">
           
		  <h4 class="font-weight-normal mb-3">Comments
			<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
		  </h4>
		  <h2 class="mb-5"><?= $comments ?></h2>
		  
		</div>
	  </div>
	</div>
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-success card-img-holder text-white">
		<div class="card-body">
                                    
		  <h4 class="font-weight-normal mb-3">Users
			<i class="mdi mdi-diamond mdi-24px float-right"></i>
		  </h4>
		  <h2 class="mb-5"><?= $users ?></h2>
		
		</div>
	  </div>
	</div>
  </div>