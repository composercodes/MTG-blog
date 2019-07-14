<div class="sidebar-content">
	<div class="sidebar-content-wrap theiaStickySidebar">
		<!-- Start Account Section -->
		<div class="account-section marg-botm row-side">
			<div class="headline up-case">
				<h3>Account</h3>
			</div>
			<div class="account-wrap main-padd">
				<ul class="accou">
                    <?php if($this->session->read('Auth.User.username')){   ?>
                        <a href="<?php echo Router::url('/profile');?>" class="transition-effect">
                        <img src="<?= $this->webroot?>img/user.png" alt="">
						<strong style="text-transform: capitalize;"><?=  $this->session->read('Auth.User.username')?></strong>
						</a>
                        <?php }else{ ?>	
                        <a href="<?php echo Router::url('/signin');?>" class="transition-effect">
							<img src="<?= $this->webroot?>img/user.png" alt="">
						Hi, Guest
						</a> 
                    <?php } ?>
                        <?php if($this->session->read('Auth.User.username')){   ?>
                        <a href="<?php echo Router::url('/signout');?>" >
							<i class="fa fa-sign-out"></i>Logout
						</a>
                        <?php }else{ ?>
						<a href="<?php echo Router::url('/signin');?>" class="transition-effect">
							<i class="fa fa-sign-in"></i>Login
						</a>
                        <?php } ?>				
					<li><a href="login.html">Sign in</a></li>
					<li><a href="register.html">Register Now</a></li>
				</ul>
			</div>
		</div>
		<!-- End Account Section -->

	</div>
</div>