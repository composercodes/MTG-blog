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
						<strong style="text-transform: capitalize;">Welcome, <?=  $this->session->read('Auth.User.username')?></strong>
						</a>
                        <?php }else{ ?>	
                        <a href="<?php echo Router::url('/signin');?>" class="transition-effect">
							<img src="<?= $this->webroot?>img/user.png" alt="">
						Hi, Guest
						</a> 
						
                    <?php } ?>
					
                        <?php if($this->session->read('Auth.User.username')){   ?>
                        <li><a href="<?php echo Router::url('/admin');?>" >
							<i class="fa fa-desktop"></i> My Dashboard
						</a></li>						
                        <li><a href="<?php echo Router::url('/signout');?>" >
							<i class="fa fa-sign-out"></i>Logout
						</a></li>
                        <?php }else{ ?>
						<li>
						<a href="<?php echo Router::url('/signin');?>" class="transition-effect">
							<i class="fa fa-sign-in"></i> Sign in</a>
						</a></li>
						<li>
						<a href="<?php echo Router::url('/signup');?>" class="transition-effect">
							Register Now
						</a>	</li>					
                        <?php } ?>				
					
					
				</ul>
			</div>
		</div>
		<!-- End Account Section -->

	</div>
</div>