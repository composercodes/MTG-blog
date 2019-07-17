<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Admin</title>
  <!-- plugins:css -->
  <?php echo $this->Html->css('admin/materialdesignicons.min.css'); ?>

  <?php echo $this->Html->css('admin/vendor.bundle.base.css'); ?>

  <!-- endinject -->
  <!-- inject:css -->
  <?php echo $this->Html->css('admin/style.css'); ?>
  
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="<?php echo Router::url('/signout');?>">
              <i class="mdi mdi-power"></i>
            </a>
          </li>
        </ul>

      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">Welcome, <?=  $this->session->read('Auth.User.username')?></span>
                
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo Router::url('/admin'); ?>">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
		   <a href="<?php echo Router::url(array('controller' => 'Posts', 'action' => 'index')); ?>" class="nav-link ">
              <span class="menu-title">Posts</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>		  
          <li class="nav-item">
		   <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'index')); ?>" class="nav-link ">
              <span class="menu-title">Users</span>
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
          </li>	
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

</body>

</html>
